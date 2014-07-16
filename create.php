<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");
  require_once("./settings.php");

  check_request_type("POST");

  $resource_params = array();

  if(isset($_POST["resource"])){
    $resource_params = $_POST["resource"];
  }

  $resource = new Resource($resource_params);

  header("Content-Type: application/json");

  if($resource->save()){
    header(
      "Content-Type: application/json",
      true,
      \HTTPStatuses\CREATED
    );
  }
  else {
    header(
      "Content-Type: application/json",
      true,
      \HTTPStatuses\UNPROCESSABLE_ENTITY
    );

    echo(json_encode($resource->errors()));
  }
?>
