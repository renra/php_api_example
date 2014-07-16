<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");
  require_once("./verbose_exit.php");

  check_request_type("DELETE");

  if(!isset($_GET["id"])){
    http_response_code(\HTTPStatuses\NOT_FOUND);
    verbose_exit("Cannot find record without an id");
  }

  $resource = Resource::find($_GET["id"]);
  $resource.destroy();

  header("Content-Type: application/json");
?>
