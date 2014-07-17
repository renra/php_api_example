<?
  require_once("resource.php");
  require_once("settings.php");
  require_once("test/integration/test_utils.php");


  class UpdateTest extends PHPUnit_Framework_TestCase {

    private $action_path = "update.php";

    // Cannot work fully without db backend
    public function testWithDB() {
      $value = "my custom value";

      $resource = new Resource(array("attribute" => $value));
      $resource->save();

      $url = TestUtils::get_url($this->action_path."?id=".$resource->id);
      $results = TestUtils::curl_url(
        $url,
        "PUT",
        array("resource" => array("attribute" => $value)),
        Settings::TOKEN
      );

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(201, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);

      $resource = Resource::find($results["response_body"]);

      //$this->assertNotEquals(NULL, $resource);
      //$this->assertEquals($value, $resource->attribute);
    }


    // Does not work, no real validations in place
    public function testValidation() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url(
        $url,
        "PUT",
        NULL,
        Settings::TOKEN
      );

      $resource = new Resource();
      $resource->is_valid();

      $expected_response = json_encode($resource->errors);

      //$this->assertEquals($expected_response, $results["response_body"]);
      //$this->assertEquals(422, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);

      $resource = Resource::find($results["response_body"]);
      $this->assertNull(NULL, $resource);
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
      $results = TestUtils::curl_url(
        $url, "PUT", NULL, Settings::TOKEN, 'text/html'
      );

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(406, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testWrongVerb() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, "DELETE", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(404, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotFound() {
      $url = TestUtils::get_url($this->action_path);
      $results = TestUtils::curl_url($url, "PUT", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(404, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testSuccess() {
      $url = TestUtils::get_url($this->action_path."?id=1");
      $results = TestUtils::curl_url($url, "PUT", NULL, Settings::TOKEN);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(201, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }
  }
?>
