<?php
// require_once '../config/database.php';

class CentralController
{
  public $database;
  public $conn;
  public function __construct()
  {
    $this->database = new Database("crystal_sky_db");
    $this->conn = $this->database->connect();
  }

  public function index()
  {

    //this should be the dashboard
    $query = "SELECT * FROM cms_users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll();

    require_once 'views/dashboard/index.php';
  }



  public function room()
  {
    // get rooms from db

    // no database available
    $query = "SELECT * FROM CMS_rooms r JOIN CMS_categories c ON r.category_id = c.id JOIN CMS_room_images i ON r.id = i.room_id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $rooms = $stmt->fetchAll();


    // $rooms = $stmt->fetchAll();

    require_once 'views/dashboard/RoomManagement/addRoom.php';
  }
  public function addRoom()
  {
      $roomNumber = $_POST['roomNumber'];
      $CategoryName = $_POST['CategoryName'];
      $roomPrice = $_POST['roomPrice'];
      $roomStatus = $_POST['roomStatus'];
      $roomDescription = $_POST['roomDescription'];

  
      // Upload the image to the server and database
      $media = $_FILES['roomImage']['name'];
      $file_extension = pathinfo($_FILES['roomImage']['name'], PATHINFO_EXTENSION);
      $filename = uniqid('room_') . '.' . $file_extension;
      $target = "media/Rooms" . $filename;
  
      if (move_uploaded_file($_FILES['roomImage']['tmp_name'], $target)) {
          // Check if the room already exists in the database
          $query = "SELECT * FROM CMS_rooms WHERE room_number = ?";
          $stmt = $this->conn->prepare($query);
          $stmt->execute([$roomNumber]);
          $result = $stmt->fetch();
  
          if ($result) {
              // Delete the uploaded file if it already exists in the database
              unlink($target);
              echo "Room already exists";
          } else {
              // Check if the category exists in the database
              $query = "SELECT id FROM CMS_categories WHERE name = ?";
              $stmt = $this->conn->prepare($query);
              $stmt->execute([$CategoryName]);
              $category = $stmt->fetch();
  
              if (!$category) {
                  // Insert the category into the database
                  $query = "INSERT INTO CMS_categories (name) VALUES (?)";
                  $stmt = $this->conn->prepare($query);
                  $stmt->execute([$CategoryName]);
  
                  $categoryId = $this->conn->lastInsertId();
              } else {
                  $categoryId = $category['id'];
              }
  
              // Insert the room data into the database
              $query = "INSERT INTO CMS_rooms (category_id, room_number, price, status, description)
              VALUES (?, ?, ?, ?, ?)";
              $stmt = $this->conn->prepare($query);
              $stmt->execute([$categoryId, $roomNumber, $roomPrice, $roomStatus, $roomDescription]);

              $query = "INSERT INTO CMS_room_images (room_id, image) VALUES (?, ?)";
              $stmt = $this->conn->prepare($query);
              $stmt->execute([$this->conn->lastInsertId(), $filename]);

  
              echo "Room added successfully";
          }
      } else {
          echo "There was an error uploading the file.";
      }
  
      header('Location: /cms/room');
  }
  
  

  public function editRoom()
  {
    //this should edit rooms
    $query = "SELECT * FROM CMS_rooms r JOIN CMS_categories c ON r.category_id = c.id JOIN CMS_room_images i ON r.id = i.room_id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $rooms = $stmt->fetchAll();



    require_once 'views/dashboard/RoomManagement/editRoom.php';
  }
  public function modifyRoom()
  {
    //submit edited room
    $id = $_POST['id'];
    $roomNumber = $_POST['roomNumber'];
    $CategoryName = $_POST['CategoryName'];
    $roomPrice = $_POST['roomPrice'];
    $roomStatus = $_POST['roomStatus'];
    $roomDescription = $_POST['roomDescription'];

    // Upload the image to the server and database
    $media = $_FILES['roomImage']['name'];
    $file_extension = pathinfo($_FILES['roomImage']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('room_') . '.' . $file_extension;
    $target = "media/Rooms/" . $filename;

    //upload the image to the server
    if (move_uploaded_file($_FILES['roomImage']['tmp_name'], $target)) {
      echo "File uploaded successfully";

    } else {
      echo "There was an error uploading the file.";
    }

    

    // update data in the database with the new data from the form
    $query = "UPDATE CMS_rooms SET room_number = ?, price = ?, status = ?, description = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$roomNumber, $roomPrice, $roomStatus, $roomDescription, $id]);

    $query = "UPDATE CMS_room_images SET image = ? WHERE room_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$filename, $id]);

    // Check if the category exists in the database
    $query = "SELECT id FROM CMS_categories WHERE name = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$CategoryName]);


    $category = $stmt->fetch();


    if (!$category) {
      // Insert the category into the database
      $query = "INSERT INTO CMS_categories (name) VALUES (?)";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$CategoryName]);

      $categoryId = $this->conn->lastInsertId();
    } else {
      $categoryId = $category['id'];
    }

    // Insert the room data into the database
    $query = "UPDATE CMS_rooms SET category_id = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$categoryId, $id]);


    //get the error message if there is any
    $error = $stmt->errorInfo();

    if ($error[0] != 00000) {
      echo "There was an error updating the room";
    } else {
      echo "Room updated successfully";
    }

    // header('Location: /cms/room');
   





  }

  public function deleteRoom()
  {
    //delete room by id connected in CMS_room_images table and CMS_rooms table
    $id = $_GET['id'];
    $query = "DELETE FROM CMS_room_images WHERE room_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);

    $query = "DELETE FROM CMS_rooms WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);

    header('Location: /cms/room');
   
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
    $username = $_POST['username'];
    $password = ($_POST['password']);
    // $password = md5($_POST['password']);
    $stmt = $this->conn->prepare('SELECT * FROM cms_users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
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
