<?
  require_once("./http_statuses.php");
  require_once("./settings.php");

  function check_request_type($wanted){
    if($_SERVER["REQUEST_METHOD"] != $wanted){
      http_response_code(\HTTPStatuses\NOT_FOUND);
      exit(Settings::$verbose ? "Not found" : "");
    }
  }
?>
