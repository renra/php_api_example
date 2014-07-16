<!DOCTYPE html>
<html lang="en">
  <head>
  </head>

  <body>
    <h1>
      CRUDding a resource
    </h1>

    <?
      require_once("./auth.php");
      require_once("./check_request_type.php");

      require_once("./resource.php");

      check_request_type("GET");
      Settings::$verbose = TRUE;

      echo("Let's go through the lifecycle of the resource<br>");
      $all = Resource::all();
      $res = Resource::find(1);

      echo("<br>");

      $res = new Resource();
      echo("Attribute:" . $res->attribute . "<br>");

      $res->attribute = "value";
      echo("Attribute:" . $res->attribute . "<br>");

      echo("<br>");

      $res->save();
      $res->save();

      echo("<br>");
      $res->destroy();
    ?>
  </body>
</html>
