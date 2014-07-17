<?
  require_once("./auth.php");
  require_once("./api_only.php");
  require_once("./check_request_type.php");

  require_once("./resource.php");

  check_request_type("GET");

  $resources = Resource::all();
  $resp_array = array();

  // Stubbing some resources since I have no db backend
  $resource1 = new Resource(array("attribute" => "value1"));
  $resource1->save();

  $resource2 = new Resource(array("attribute" => "value2"));
  $resource2->save();

  $resources = array($resource1, $resource2);
  //


  // Mapping
  foreach($resources as $resource){
    array_push($resp_array, $resource->attributes());
  }
  //

  header("Content-Type: application/json");
  echo(json_encode($resp_array));
?>
