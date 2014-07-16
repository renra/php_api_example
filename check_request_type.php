<?
  require_once("./http_statuses.php");

  function check_request_type($wanted){
    if($_SERVER["REQUEST_METHOD"] != $wanted){
      http_response_code(\HTTPStatuses\NOT_ACCEPTABLE);
      exit("Not acceptable");
    }
  }
?>
