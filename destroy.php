<?
  require_once("auth.php");
  require_once("api_only.php");
  require_once("check_request_type.php");

  require_once("resource.php");

  require_once("http_statuses.php");

  check_request_type("DELETE");

  if(!isset($_GET["id"])){
    render_status(\HTTPStatuses\NOT_FOUND);
  }

  $resource = Resource::find($_GET["id"]);

  // Stub
  $resource = new Resource();

  $resource->destroy();

  render_status(\HTTPStatuses\NO_CONTENT);
?>
