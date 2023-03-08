<?php
// require_once '../config/database.php';

class CentralController
{
  public $database;
  public $conn;
  public function __construct()
  {
    $this->database = new Database("db_Central");
    $this->conn = $this->database->connect();
  }

  public function index()
  {

    //this should be the dashboard
    $query = "SELECT * FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll();

    require_once 'views/dashboard/index.php';
  }
  public function events()
  {
    //this should adding events
    require_once 'views/dashboard/events.php';
  }
  public function addEvent()
  {
    //this should adding events
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $image = $_POST['image'];

    $test = json_encode($title) . json_encode($description) . json_encode($date) . json_encode($time) . json_encode($image);
    echo $test;

    // $query = "INSERT INTO events (title, description, date, time, image) VALUES (?,?,?,?,?)";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute([$title, $description, $date, $time, $image]);

    header('Location: /cms/index');
  }
  public function room()
  {
    // get rooms from db

    // no database available
    // $query = "SELECT * FROM rooms";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute();


    // $rooms = $stmt->fetchAll();

    require_once 'views/dashboard/RoomManagement/addRoom.php';
  }
  public function addRoom()
  {


    $roomNumber = $_POST['roomNumber'];
    $roomType = $_POST['roomType'];
    $roomPrice = $_POST['roomPrice'];
    $roomStatus = $_POST['roomStatus'];
    $roomImage = $_POST['roomImage'];

    $test = json_encode($roomNumber) . json_encode($roomType) . json_encode($roomPrice) . json_encode($roomStatus) . json_encode($roomImage);
    echo $test;

    // $query = "INSERT INTO rooms (roomNumber, roomType, roomPrice, roomStatus, roomImage) VALUES (?,?,?,?,?)";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute([$roomNumber, $roomType, $roomPrice, $roomStatus, $roomImage]);


    // header('Location: /cms/index');




  }
  public function editRoom()
  {
    //this should edit rooms
    // get room by id
    // $id = $_GET['id'];
    // $query = "SELECT * FROM rooms WHERE id = ?";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute([$id]);
    // $room = $stmt->fetch();



    require_once 'views/dashboard/RoomManagement/editRoom.php';
  }
  public function modifyRoom()
  {
    //submit edited room
    $id = $_POST['id'];
    $roomNumber = $_POST['roomNumber'];
    $roomType = $_POST['roomType'];
    $roomPrice = $_POST['roomPrice'];
    $roomStatus = $_POST['roomStatus'];
    $roomImage = $_POST['roomImage'];
  
    $test = json_encode($id) . json_encode($roomNumber) . json_encode($roomType) . json_encode($roomPrice) . json_encode($roomStatus) . json_encode($roomImage);
    echo $test;

    // $query = "UPDATE rooms SET roomNumber = ?, roomType = ?, roomPrice = ?, roomStatus = ?, roomImage = ? WHERE id = ?";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute([$roomNumber, $roomType, $roomPrice, $roomStatus, $roomImage, $id]);

    // header('Location: /cms/index');

  }

  public function deleteRoom()
  {
    //delete room
    $id = $_GET['id'];
    $query = "DELETE FROM rooms WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);

    header('Location: /cms/index');
  }

  public function login()
  {
    // Display a form for logging in
    require_once 'views/user/login.php';
  }

  public function logout()
  {
    session_start();
    session_destroy();
    header('Location: /cms/login');
  }

  public function authenticate()
  {
    $email = $_POST['email'];
    $password = ($_POST['password']);
    // $password = md5($_POST['password']);
    $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();


    if ($user) {
      // Set the customer_id and customer_name session variables
      session_start();
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      // echo 'Success: You are now logged in';
      header('Location: /cms/index');
      return true;
    } else {
      echo 'Error: Invalid email address or password';
      return false;
    }
  }
}

$app = new CentralController();
