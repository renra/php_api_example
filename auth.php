<?
  require_once("./http_statuses.php");

  // Token would be later in db and will identify a client
  const TOKEN = "1234";

  $_headers = getallheaders();
  $token = NULL;

  // Accept  application/json
  // $_SERVER["REQUEST_METHOD"] -- GET, POST, PUT, DELETE

  if(isset($_headers["Authentication"])){
    $token = $_headers["Authentication"];
  }
  else if(isset($_GET["token"])){
    // This is here just so that index works with ?token=1234
    $token = $_GET["token"];
  }

  if($token != TOKEN){
    http_response_code(\HTTPStatuses\UNAUTHORIZED);
    exit("Not authorized");
  }

  echo("<br>");
?>
