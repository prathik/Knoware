<?php
class knoware_mysql {
	public $mysql;
	private $username = "codedro1_main";
	private $password = "TTmast#1";
	private $host = "localhost";
	private $database = "codedro1_knoware";

	function __construct() {
		$this->mysql = new mysqli($this->host, $this->username, $this->password, $this->database);
	}

	function close() {
		$this->mysql->close();
	}

}
