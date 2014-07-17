<?
  require_once("./settings.php");

  class Resource {
    private $id = NULL;
    private $attribute = NULL;
    private $errors = NULL;


    // Fill in reasonable default values if necessary
    public function __construct($attributes = array()){
      $this->attribute = "Default attribute value";

      foreach($attributes as $key => $value){
        $this->$key = $value;
      }
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

    // I'm also relying on the fact that this ORM will provide protection
    //   from SQL injection

    public static function all(){
      if(Settings::$verbose){
        echo("Fetching all records<br>");
      }
    }

    public static function find($id){
      if(Settings::$verbose){
        echo("Fetching record with id " . $id . "<br>");
      }
    }

    public function is_valid(){
      //Clean every time it's called
      $this->errors = array();

      // Some conditions may come here and errors can be filled

      return count($this->errors) > 0 ? FALSE : TRUE;
    }

    public function update_attributes($attributes = array()){
      foreach($attributes as $key => $value){
        $this->$key = $value;
      }

      return $this->save();
    }

    public function save(){
      $success = $this->is_valid();

      if($success){

        if(isset($this->id)){
          if(Settings::$verbose){
            echo("Updating record with id " . $this->id . "<br>");
          }

          // do an update
        }
        else{
          if(Settings::$verbose){
            echo("Creating record<br>");
          }

          // do an insert and get the id
          $this->id = 1;
        }

      }

      return $success;
    }

    public function destroy(){
      if(isset($this->id)){
        if(Settings::$verbose){
          echo("Deleting record with id " . $this->id . "<br>");
        }

        // do a delete
      }
    }

    public function attributes(){
      return array("attribute" => $this->attribute);
    }
  };
?>
