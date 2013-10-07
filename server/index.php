<?php
require(dirname(dirname(__FILE__))."/class/knoware-load.php");
Class Server {
	public $url;
	public $user_id;
	private $replyObject;
	private $mysql;

	function __construct() {
		$this->mysql = new knoware_mysql();
		if(isset($_GET['q'])){
			$this->url = explode('/', $_GET['q']);
			//Determine User Id from Cookies, set to default till functionality is built
			$this->user_id = $_COOKIE[ 'user_id' ];
		} else {
			$url = array();
			$url[0] = "";
		}
	}

	function __destruct() {
		$this->mysql->close();
	}

	function router() {
		switch($_SERVER['REQUEST_METHOD']) {
		case 'GET':
			switch($this->url[0]) {
			case "": 
				break;
			case "get-thesis": 
				$this->getThesis();
				break;
			case "approve":
				$this->approveThesis();
				break;
			case "reject":
				$this->rejectThesis();
				break;
			case "user":
				$this->userDetails();
				break;
			case "get-comments":
				$this->getComments();
				break;
			default: 
				$this->errorReply();
				break;
			}

			break;

			case 'PUT':
				switch($this->url[0]) {
					case "add-thesis":
						$this->insertThesis();
						break;
					case "add-comment":
						$this->addComment();
						break;
					default:
						$this->errorReply();
						break;
				}
				break;

			default: 
				$this->errorReply; 
				break;
		}

	}

	function getThesis() {
		if(isset($this->url[1]) && is_numeric($this->url[1])) {
			$result_object = $this->mysql->mysql->query("SELECT * FROM thesis WHERE user_id = '$this->user_id' ORDER BY posted_on DESC");
			if($result_object !== false) {
				$this->replyObject = array();
				while($result = $result_object->fetch_object()) {
					$this->replyObject[] = $result;
				}
				if(count($this->replyObject) <= 0 ) {
					$this->errorReply();
					return;
				}
			} else {
				$this->errorReply();
				return;
			}

		} else if (isset($this->url[1]) && $this->url[1] == "id") {
			$this->singleThesis($this->url[2]);
			return;
		} else {
			$this->errorReply();
			return;
		}

		$this->reply();
	}

	function errorReply() {
		header("HTTP/1.1 400 Bad Request");
	}

	function reply() {
		header("Content-Type: application/json");
		echo json_encode($this->replyObject);
	}

	function insertThesis() {
		$data = json_decode(file_get_contents("php://input"));
		$data->posted_on = mysqli_real_escape_string($this->mysql->mysql, $data->year.'-'.$data->month.'-'.$data->day);
		$data->description = mysqli_real_escape_string($this->mysql->mysql, nl2br($data->description ));
		$data->title = mysqli_real_escape_string($this->mysql->mysql, $data->title);
		$var = $this->mysql->mysql->query( "INSERT INTO thesis ".
							"values ( NULL, {$this->user_id} ".
							", '{$data->posted_on}', '{$data->posted_on}' + INTERVAL {$data->review_on} WEEK".
							", '{$data->title}', '{$data->description}', 'review' )");
		if($var) {
			$this->replyObject = array("result" => "Success");
		} else {
			$this->replyObject = array('data' => $data, "debug"=> $this->mysql->mysql->error, "result" => "Failure");
		}
		$this->reply();	
		return true;
	}

	function singleThesis($thesis_id) {
		if(isset($thesis_id) && is_numeric($thesis_id)) {
			$singleReplyObject = $this->mysql->mysql->query("SELECT * FROM thesis WHERE thesis_id = {$thesis_id} and user_id = {$this->user_id}");
			if($singleReplyObject && $singleReplyObject->num_rows == 1) {
				$this->replyObject = $singleReplyObject->fetch_object();
				$this->reply();
			} else {
				$this->errorReply();
			}
		}
	}
	
	function approveThesis() {
		if(isset($this->url[1]) && is_numeric($this->url[1])) {
			$var = $this->mysql->mysql->query("UPDATE thesis SET review_state = 'approved' WHERE thesis_id = {$this->url[1]}");
			$this->singleThesis($this->url[1]);
		} else {
			$this->errorReply();
		}
	}

        function rejectThesis() {
                if(isset($this->url[1]) && is_numeric($this->url[1])) {
                        $var = $this->mysql->mysql->query("UPDATE thesis SET review_state = 'rejected' WHERE thesis_id = {$this->url[1]}");
                        $this->singleThesis($this->url[1]);
                } else {
                        $this->errorReply();
                }   
        }   

	function userDetails() {
		$var = $this->mysql->query( "SELECT fullname as name, email, username FROM users WHERE user_id = {$this->user_id} ");
		if($var->num_rows == 1) {
			$this->replyObject = $var->fetch_object();
			$this->reply();
		} else {
			$this->errorReply();
		}
	}

	function addComment() {
		 if(isset($this->url[1]) && is_numeric($this->url[1]) && $this->is_current_user_idea($this->url[1])) {
		 			 $data = json_decode(file_get_contents("php://input"));
					 $data->comment = mysqli_real_escape_string($this->mysql->mysql, $data->comment);
					 $status = $this->mysql->query("INSERT INTO comments VALUES (NULL, '{$this->url[1]}', '{$data->comment}', NOW())");
					 if($status) {
						$this->getComments();
					} else {
					  $this->errorReply();
					  }
		 } else {
		   $this->errorReply();
		 }
	}

	function is_current_user_idea($id) {
		 return true;
	}

	function getComments() {
		 if(isset($this->url[1]) && is_numeric($this->url[1]) && $this->is_current_user_idea($this->url[1])) {
		 			 $results = $this->mysql->query("SELECT comment FROM comments WHERE thesis_id = '{$this->url[1]}' ORDER BY posted_on ASC");
					 if($results) {
					 	      if($results->num_rows != 0) {
									    $resultArray = array();
									    while( $result = $results->fetch_object()) {
							       		    $resultArray[] = $result;
									    }
							 		    $this->replyObject = $resultArray;
							 		    $this->reply();
							 } else {
							   	$this->replyObject = array(array( "comment" => "No Comments" )) ;
								$this->reply();
								}
						      } else {
						      $this->errorReply();
						      }
		 } else {
		   $this->errorReply();
		   }
	}

}
$user = new UserState();
if($user->is_user_logged_in()) {
	$server = new Server();
	$server->router();
}
?>
