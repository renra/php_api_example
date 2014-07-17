<?
  require_once("http_statuses.php");
  require_once("utils.php");

  $_headers = getallheaders();

  if(!preg_match("/application\/json/", $_headers["Accept"])){
    render_status(\HTTPStatuses\NOT_ACCEPTABLE);
  }
?>
