<?
  require_once("./settings.php");

  function verbose_exit($str){
    exit(Settings::$verbose ? $str : "")
  }
?>
