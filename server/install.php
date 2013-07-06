<?php
require("config.php");
$mysql = new knoware_mysql();

class Installer {
	private $mysql;
	function __construct() {
		$this->mysql = new knoware_mysql();	
	}

	function install_thesis() {
		$check = $this->mysql->mysql->query("SELECT 1 FROM thesis");
		if($check === false) {
			$result = $this->mysql->mysql->query("CREATE TABLE thesis (thesis_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, posted_on DATE NOT NULL, review_time DATE NOT NULL, title VARCHAR(200) NOT NULL, description TEXT, review_state VARCHAR(10) NOT NULL)");
			if($result) {
				$this->success('Completed thesis table creation.');
			} else {
				$this->failure('There was a problem creating the thesis table.');
			}

		} else {
			$this->warning('Looks like thesis table is present.');
		}
	}

	function install_users() {
		$check = $this->query( "SELECT 1 FROM users" );
		if($check == false) {
			$result = $this->query( "CREATE TABLE users (user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password TEXT NOT NULL, fullname VARCHAR(100) NOT NULL)" );
			if($result) {
				$this->success('Completed users table creation.');
			} else {
				$this->failure('There was a problem creating users table.');
			}
		} else {
			$this->warning('Looks like users table is already present.');
		}
	}

	function query($query_string) {
		return $this->mysql->mysql->query($query_string);
	}

	function success($message) {
		echo '<p class = "success">'.$message.'</p>';
	}

	function failure($message) {
		echo '<p class = "failure">'.$message.'</p>';
	}

	function warning($message) {
		echo '<p class = "warning">'.$message.'</p>';
	}



	function output_begin() {
		echo '<!DOCTYPE html><html><head><title>Install KnoWare</title>'.
			'<style type = "text/css">'.
			'.success { color: green; }'.
			'.failure { color: red; }'.
			'.warning { color: orange; }'.
			'</style>'.
			'</head><body>';
	}

	function output_end() {
		echo '</body></html>';
	}

	function __destruct() {
		$this->mysql->mysql->close();
	}
}

$install = new Installer();
$install->output_begin();
$install->install_users();
$install->install_thesis();
$install->output_end();

?>
