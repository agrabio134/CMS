<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "";

    public function __construct($db_name)
    {
      $this->database = $db_name;
    }

    public function connect() {
        $conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }


  

}

?>