<?php

/*
 * @file
 * a simple  class to parse rest responses from json or xml to html .
 * 
 */

abstract class restResponseParser{
  protected $payload;


  function __construct($payload) {
    $this->payload = $payload;
  }
  
  abstract function parse();
  
  
  
  public static function getInstance($content_type, $payload){
    switch ($content_type) {
      case 'application/json':
         return new jsonParser($payload);
        break;
    }
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


