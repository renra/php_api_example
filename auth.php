<?
  require_once("http_statuses.php");
  require_once("settings.php");
  require_once("utils.php");

  $_headers = getallheaders();
  $token = NULL;

  // Accept  application/json
  // $_SERVER["REQUEST_METHOD"] -- GET, POST, PUT, DELETE

  if(isset($_headers["Authentication"])){
    $token = $_headers["Authentication"];
  }

  if($token != Settings::TOKEN){
    render_status(\HTTPStatuses\UNAUTHORIZED);
  }
?>
