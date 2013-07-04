<?php
require("config.php");
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
			$this->user_id = 1;
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
			$page = ($this->url[1] - 1)*10;
			$upper_limit = $page + 9;
			$result_object = $this->mysql->mysql->query("SELECT * FROM thesis WHERE user_id = '$this->user_id' ORDER BY posted_on LIMIT $page,$upper_limit");
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
		$data->posted_on = mysql_real_escape_string($data->year.'-'.$data->month.'-'.$data->day);
		$data->description = mysql_real_escape_string(nl2br($data->description ));
		$data->title = mysql_real_escape_string($data->title);
		$var = $this->mysql->mysql->query( "INSERT INTO thesis ".
							"values ( NULL, {$this->user_id} ".
							", '{$data->posted_on}', '{$data->posted_on}' + INTERVAL {$data->review_on} WEEK".
							", '{$data->title}', '{$data->description}', 'review' )");
		if($var) {
			$this->replyObject = array("data" => $data->description, "result" => "Success");
		} else {
			$this->replyObject = array("data"=> $data->description, "result" => "Failure");
		}
		$this->reply();	
		return true;
	}

	function singleThesis($thesis_id) {
		if(isset($thesis_id) && is_numeric($thesis_id)) {
			$singleReplyObject = $this->mysql->mysql->query("SELECT * FROM thesis WHERE thesis_id = {$thesis_id}");
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

}
$server = new Server();
$server->router();
?>
