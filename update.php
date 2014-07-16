<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  require_once("./http_statuses.php");
  require_once("./settings.php");

  check_request_type("PUT");

  $resource_params = array();

  if(!isset($_POST["id"])){
    http_response_code(\HTTPStatuses\NOT_FOUND);
    exit(Settings::$verbose ? "Cannot find record without an id" : "");
  }

  if(isset($_POST["resource"])){
    $resource_params = $_POST["resource"];
  }

  $resource = Resource::find($_POST["id"]);

  if($resource->update_attributes($resource_params)){
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
