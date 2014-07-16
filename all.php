<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  check_request_type("GET");

  $resources = Resource::all();

  //Stubbing some responses since I have no db backend
  $resources = array(
    new Resource(array("attribute" => "value1")),
    new Resource(array("attribute" => "value2")),
    new Resource()
  );

  $resp_array = array();

  foreach($resources as $resource){
    array_push($resp_array, $resource->attributes());
  }

  header("Content-Type: application/json");
  echo(json_encode($resp_array));
?>
