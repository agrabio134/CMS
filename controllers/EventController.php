<?php

class EventController
{

  public $database;
  public $conn;


  public function __construct()
  {
    $this->database = new Database("db_CMS");
    $this->conn = $this->database->connect();
  }

  public function event()
  {
    $query = "SELECT * FROM events";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $events = $stmt->fetchAll();

    require_once 'views/event.php';
  }
}

$app = new EventController();
?>