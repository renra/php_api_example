<?
  // Token would be later in db per client
  const TOKEN = '1234';
  const UNAUTHORIZED = 401;

  $headers = getallheaders();
  $token = NULL;

  if(isset($headers["Authentication"])){
    $token = $headers["Authentication"];
  }
  else if(isset($_GET["token"])){
    // This is here just so that index works with ?token=1234
    $token = $_GET["token"];
  }

  if($token != TOKEN){
    http_response_code(UNAUTHORIZED);
    exit("Not authorized");
  }

  echo("<br>");
?>
