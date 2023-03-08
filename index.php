<?php
//database configuration file
require_once 'config/database.php';

require_once 'controllers/CentralController.php';
require_once 'controllers/EventController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[1] == "cms") {


  if (empty($uri[2])) {
    $action = "index";
  } else {
    $action = $uri[2];
  }
  if (isset($uri[3])== "events") {
    $action = $uri[3];

  }
  

  
  
 



// instantiate the controller and call the action
$CentralController = new CentralController();
$EventsController = new EventController();
  if (method_exists($EventsController, $action)) {
    $EventsController = new $EventsController();
    $EventsController->$action();
  } elseif (method_exists($CentralController, $action)) {
    $CentralController = new $CentralController();
    $CentralController->$action();
  }
  else {
    // Action not found
    header("HTTP/1.0 404 Not Found");
    exit();
  }
}
