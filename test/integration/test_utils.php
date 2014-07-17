<?
  class TestUtils {
    public static $domain_tail = "php_api_example/";

    public static function get_url($action_path){
      return "localhost/" . self::$domain_tail . $action_path;
    }

    public static function curl_url(
      $url,
      $http_verb = "GET",
      $data = NULL,
      $token = NULL,
      $accepted_content_type = "application/json"
    ){

      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $http_verb);

      if(($http_verb == "POST" || $http_verb == "PUT") && is_array($data)){
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      }

      curl_setopt(
        $curl, CURLOPT_HTTPHEADER, array(
          "Accept:".$accepted_content_type,
          "Authentication:".$token
        )
      );

      $response_body = curl_exec($curl);

      $curl_info = curl_getinfo($curl);
      $status_code = $curl_info["http_code"];
      $content_type = $curl_info["content_type"];

      curl_close($curl);

      return array(
        "response_body" => $response_body,
        "status_code" => $status_code,
        "content_type" => $content_type
      );
    }
  }
?>
