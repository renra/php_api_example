<?
  require_once("resource.php");

  class ResourceTest extends PHPUnit_Framework_TestCase {
    public function testConstructor() {
      $value = "value";
      $resource = new Resource(array("attribute" => $value));

      $this->assertEquals($value, $resource->attribute);
    }

    public function testAttributes() {
      $value = "value";
      $resource = new Resource(array("attribute" => $value));
      $resource->save();

      $expected_result = array(
        "id" => $resource->id,
        "attribute" => $resource->attribute
      );

      $this->assertEquals($expected_result, $resource->attributes());
    }

    public function testUpdateAttributes() {
      $value = "value";
      $resource = new Resource();

      $resource->update_attributes(array("attribute" => $value));

      $this->assertEquals($value, $resource->attribute);
    }

    public function testSave() {
      $resource = new Resource();

      $this->assertTrue($resource->save());
      $this->assertNotEquals(NULL, $resource->id);
    }

    //Tests on Resource#is_valid could be interesting
    public function testIsValid() {
      $resource = new Resource();

      $this->assertTrue($resource->is_valid());
    }
  }
?>
