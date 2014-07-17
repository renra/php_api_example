<?
  require_once("./http_statuses.php");
  require_once("./settings.php");

  function check_request_type($wanted){
    if($_SERVER["REQUEST_METHOD"] != $wanted){
      render_status(\HTTPStatuses\NOT_FOUND);
    }
  }
?>
