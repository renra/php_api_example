<?
  function render_status($status_code, $exit = TRUE){
    header(
      "Content-Type: application/json",
      true,
      $status_code
    );

    if($exit){
      exit();
    }
  }
?>
