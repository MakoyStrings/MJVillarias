<?php

Class Database{
private $servername = "localhost";
private $username = "root";
private $password = "";
private $dbname = "contacts";
private $conn;


public function open(){
  $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
  return $this->conn;

  if ($this->conn->connect_error) {
    die("Connection failed: " . $this->conn->connect_error);
  }

}


public function close(){
  $this->conn = null;
}

}

$mysqli = new Database();

?>