<?
  $_headers = getallheaders();

  if(!preg_match("/application\/json/", $_headers["Accept"])){
    http_response_code(\HTTPStatuses\NOT_ACCEPTABLE);
    exit("Not acceptable");
  }
?>
