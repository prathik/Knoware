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
			default: 
				$this->errorReply;
				break;
			}

			break;

			case 'PUT':
				$this->insertThesis();
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
		return true;
	}
}
$server = new Server();
$server->router();
?>
