<?php

class EventController
{

  public $database;
  public $conn;
  public function __construct()
  {
    $this->database = new Database("crystal_sky_db");
    $this->conn = $this->database->connect();
  }

  public function events()
  {
    //this should adding events


    require_once 'views/dashboard/events.php';
  }
  public function addEvent()
  {
    //get the users id from the session
    session_start();
    $user_id = $_SESSION['id'];

    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $media = $_FILES['media']['name'];
    $file_extension = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
    $filename = "$media";
    $target = "media/Announcements/" . $filename;


    if (move_uploaded_file($_FILES['media']['tmp_name'], $target)) {
      // Insert the event data into the database
      $query = "SELECT * FROM cms_contents WHERE media = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$filename]);
      $result = $stmt->fetch();

      if ($result) {
        //delete the uploaded file if it already exists in the database
        unlink($target);
        http_response_code(400);
        echo "File already uploaded";
      } else {
        $query = "INSERT INTO cms_contents (title, category, description, date, time, media, user_id) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$title, $category, $description, $date, $time, $media, $user_id]);
        http_response_code(200);
        echo "File uploaded successfully";
      }
    } else {
      http_response_code(500);
      echo "There was an error uploading the file.";
    }
    header('Location: /cms/index');
  }


}

$app = new EventController();
?>