<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");
  require_once("./verbose_exit.php");

  check_request_type("GET");

  if(!isset($_GET["id"])){
    http_response_code(\HTTPStatuses\NOT_FOUND);
    verbose_exit("Cannot find record without an id");
  }

  $resource = Resource::find($_GET["id"]);

  //Stubbing the response since I have no db backend
  $resource = new Resource(array("attribute" => "value1"));

  header("Content-Type: application/json");
  echo(json_encode($resource->attributes()));
?>
