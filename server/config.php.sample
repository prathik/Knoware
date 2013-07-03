<?php
class knoware_mysql {
	public $mysql;
	private $username = "root";
	private $password = "password";
	private $host = "localhost";
	private $database = "knoware";

	function __construct() {
		$this->mysql = new mysqli($this->host, $this->username, $this->password, $this->database);
	}

	function close() {
		$this->mysql->close();
	}

}
