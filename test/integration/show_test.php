<?
  require_once("resource.php");
  require_once("settings.php");
  require_once("test/integration/test_utils.php");


  class ShowTest extends PHPUnit_Framework_TestCase {

    private $action_path = "show.php";

    // Cannot work fully without db backend
    public function testWithDB() {
      $value = "my custom value";

      $resource = new Resource(array("attribute" => $value));
      $resource->save();

      $url = TestUtils::get_url($this->action_path."?id=".$resource->id);
      $results = TestUtils::curl_url($url, Settings::TOKEN);

      $expected_response = json_encode($resource->attributes());

      //$this->assertEquals($expected_response, $results["response_body"]);
      $this->assertEquals(200, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testUnauthorized() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(401, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotAcceptable() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, Settings::TOKEN, 'text/html');

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(406, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotFound() {
      $url = TestUtils::get_url($this->action_path);
      $results = TestUtils::curl_url($url, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(404, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testSuccess() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, Settings::TOKEN);

      $expected_response = '{"attribute":"value1"}';

      $this->assertEquals($expected_response, $results["response_body"]);
      $this->assertEquals(200, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }
  }
?>
