<?
  require_once("resource.php");
  require_once("settings.php");
  require_once("test/integration/test_utils.php");


  class AllTest extends PHPUnit_Framework_TestCase {

    public function testUnauthorized() {
      $url = TestUtils::get_url("all.php");
      $results = TestUtils::curl_url($url);

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(401, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testNotAcceptable() {
      $url = TestUtils::get_url("all.php");
      $results = TestUtils::curl_url($url, Settings::TOKEN, 'text/html');

      $this->assertEquals("", $results["response_body"]);
      $this->assertEquals(406, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }

    public function testSuccess() {
      $url = TestUtils::get_url("all.php");
      $results = TestUtils::curl_url($url, Settings::TOKEN);

      $expected_response = '[{"attribute":"value1"},{"attribute":"value2"},{"attribute":"Default attribute value"}]';

      $this->assertEquals($expected_response, $results["response_body"]);
      $this->assertEquals(200, $results["status_code"]);
      $this->assertEquals("application/json", $results["content_type"]);
    }
  }
?>
