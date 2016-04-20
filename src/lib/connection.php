<?php

class Connection
{
	public $conn = null;
	public $env = 'dev';
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pizz";
		$this->conn = new mysqli($servername, $username, $password, $dbname);
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		} 
	}
}

//(md5($str) == "8b1a9953c4611296a827abf8c47804d7")
//
//
//