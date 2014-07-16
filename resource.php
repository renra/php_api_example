<?
  class Resource {
    private $id = NULL;
    private $attribute = NULL;


    // Fill in reasonable default values if necessary
    public function __construct(){
      $this->attribute = "Default attribute value";
    }

    // Just in case we want to process the data somehow
    //   at read or write time
    public function __get($attr_name){
      return $this->$attr_name;
    }

    public function __set($attr_name, $attr_value){
      $this->$attr_name = $attr_value;
    }


    // The following are stubbed methods for db communication
    //   I hope that in PHP they can be provided by some ORM
    //   something in the spirit of https://rubygems.org/gems/activerecord

    public static function all(){
      echo("Fetching all records<br>");
    }

    public static function find($id){
      echo("Fetching record with id " . $id . "<br>");
    }

    public function is_valid(){
      // Some conditions may come here
      return TRUE;
    }

    public function save(){
      $retval = $this->is_valid();

      if($retval){

        if(isset($this->id)){
          echo("Updating record with id " . $this->id . "<br>");
          // do an update
        }
        else{
          echo("Creating record<br>");
          // do an insert which should return an id
          $this->id = 1;
        }

      }

      return $retval;
    }

    public function destroy(){
      if(isset($this->id)){
        echo("Deleting record with id " . $this->id . "<br>");
        // do a delete
      }
    }

    public function attributes(){
      return array("attribute" => $this->attribute);
    }
  };
?>
