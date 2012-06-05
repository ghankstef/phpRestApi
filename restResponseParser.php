<?php

/*
 * @file
 * a simple  class to parse rest responses from json or xml to html .
 * 
 */

abstract class restResponseParser{
  protected $payload;
  private static $instance;

  function __construct($payload) {
    $this->payload = $payload;
  }
  
  abstract function parse();
  
  
  /**
   * @function getInstance - singleton style object generation
   * @param type $content_type - http content type  such as application/json
   * @param type $payload
   * @return type 
   */
  public static function getInstance($content_type, $payload){
    if (empty( self::$instance)){ 
      switch ($content_type) {
        case 'application/json':
           self::$instance =  new jsonParser($payload);
          break;
      }
    }
    return self::$instance;
  }
}

class jsonParser extends restResponseParser{
  function __construct($payload) {
    parent::__construct($payload);
  }
  
  public function parse(){
    $data = json_decode($this->payload);
    $output = "<ul>";
    foreach($data as $node) {
      $output .= "<li>" . $node->text . "</li>";
    }
    $output .= "</ul>";
    return $output;
  }
}


?>


