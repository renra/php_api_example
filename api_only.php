<?
  require_once("./http_statuses.php");
  require_once("./settings.php");

  $_headers = getallheaders();

  if(!preg_match("/application\/json/", $_headers["Accept"])){
    http_response_code(\HTTPStatuses\NOT_ACCEPTABLE);

    exit(Settings::$verbose ? "Not acceptable" : "");
  }
?>
