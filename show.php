<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");

  check_request_type("GET");

  if(!isset($_GET["id"])){
    render_status(\HTTPStatuses\NOT_FOUND);
  }

  $resource = Resource::find($_GET["id"]);

  //Stubbing the resource since I have no db backend
  $resource = new Resource(array("attribute" => "value1"));

  header("Content-Type: application/json");
  echo(json_encode($resource->attributes()));
?>
