<?
  require_once("resource.php");
  require_once("settings.php");
  require_once("test/integration/test_utils.php");


  class DestroyTest extends PHPUnit_Framework_TestCase {

    private $action_path = "destroy.php";

    // Cannot work fully without db backend
    public function testWithDB() {
      $resource = new Resource();
      $resource->save();

      $url = TestUtils::get_url($this->action_path."?id=".$resource->id);
      $results = TestUtils::curl_url($url, "DELETE", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(204, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);

      $this->assertNULL(Resource::find($resource->id));
    }

    public function testUnauthorized() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, "DELETE", NULL);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(401, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotAcceptable() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url(
        $url, "DELETE", NULL, Settings::TOKEN, 'text/html'
      );

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(406, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotFound() {
      $url = TestUtils::get_url($this->action_path);
      $results = TestUtils::curl_url($url, "DELETE", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(404, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testWrongVerb() {
      $url = TestUtils::get_url($this->action_path);
      $results = TestUtils::curl_url($url, "GET", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(404, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testSuccess() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, "DELETE", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(204, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }
  }
?>
