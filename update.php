<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");

  check_request_type("PUT");

  $resource_params = array();

  if(!isset($_GET["id"])){
    render_status(\HTTPStatuses\NOT_FOUND);
  }

  if(isset($_POST["resource"])){
    $resource_params = $_POST["resource"];
  }

  $resource = Resource::find($_GET["id"]);

  // Stub
  $resource = new Resource();

  if($resource->update_attributes($resource_params)){
    render_status(\HTTPStatuses\CREATED);
  }
  else {
    render_status(\HTTPStatuses\UNPROCESSABLE_ENTITY, FALSE);
    echo(json_encode($resource->errors()));
  }
?>
