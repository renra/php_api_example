<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");

  check_request_type("POST");

  $resource_params = array();

  if(isset($_POST["resource"])){
    $resource_params = $_POST["resource"];
  }

  $resource = new Resource($resource_params);

  if($resource->save()){
    render_status(\HTTPStatuses\CREATED, FALSE);
    echo($resource->id);
  }
  else {
    render_status(\HTTPStatuses\UNPROCESSABLE_ENTITY, FALSE);
    echo(json_encode($resource->errors()));
  }
?>
