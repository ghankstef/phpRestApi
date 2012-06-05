<?php

/**
 * @file
 * restRequest is abstract class that implements REST requests and responses
 * each http method  (get, post, put, etc ..)  gets its own subclass 
 * @author ghank
 */


/**
* restClient abstract class sets request and response methods and properties
*/
abstract class restReqeust {
  protected $base_url;
  protected $full_url;
  protected $request_params = array();
  protected $request_type;
  protected $response;
  protected $response_info;
  protected $ch; // curl resource


  abstract public function send_request();
  abstract public function get_request_info();
  
  /**
   * @param type $output_type is expected to be xml, json, atom, rss
   */
  public function set_base_url($url){
    $this->base_url = $url;
  }
  
  public function get_base_url(){
    return $this->base_url;
  }
  
  public function get_full_url(){
    return $this->full_url;
  }
  
  /**
   * @function set_full_url flattens request params into a string
   * @param type $params should be an array of key vaue pairs
   */
  public function set_full_url($params){
    $this->request_params = $params;
    $this->full_url = $this->base_url . '?';
    $i=0;
    foreach ($this->request_params as $key => $value) {
      if($i > 0){
        $this->full_url .= '&'; 
      }
      $this->full_url .= urlencode($key) . '=' . urlencode($value);
      ++$i;
    }
  }
  
  public function get_response(){
      return $this->response;
  }
  
  public function get_response_status(){
      return $this->response_status;
  }
  
  public static function getInstance($type){
    switch ($type){
      case 'get':
        return new Get();
      break;
      case 'post':
        return new Post();
      break;
      case 'put':
        return new Put();
      break;
      case 'delete':
        return new Delete();
      break;
    }  
  }  

}

/**
 ** Get implements restClient for http Get requests 
 */
class Get extends restReqeust{
  
  function __construct() {
    $this->request_type = 'get';
  }
  
  /*
   * execute a php curl request and return the result
   */
  function send_request(){
    $this->ch = curl_init($this->full_url);
    curl_setopt($this->ch, CURLOPT_HTTPGET, 1);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_HEADER, 0);
    try{
      return curl_exec($this->ch);   
    }
    catch (Exception $e){
      throw $e;
    }
    curl_close($thisch);
  }

  function get_request_info(){
    return curl_getinfo($this->ch); 
  }
  
}

/*
 * return metadata on last curl request
 */




/**
 ** Post implements restClient for http Post requests 
 */
class Post extends restReqeust{
  function __construct() {
    $this->request_type = 'post';
  }
  function send_request(){
    
  }
  function process_response(){
    
  }
  function get_request_info(){
    return curl_getinfo($this->ch); 
  }
}

/**
 ** Put implements restClient for http Put requests 
 */
class Put extends restReqeust{
  function __construct() {
    $this->request_type = 'put';
  }
  function send_request(){
    
  }
  function process_response(){
  
    
  }
  function get_request_info(){
    return curl_getinfo($this->ch); 
  }
}

/**
 ** Delete implements restClient for http Delete requests 
 */
class Delete extends restReqeust{
  function __construct() {
    $this->request_type = 'delete';
  }
  function send_request(){
    
  }
  function process_response(){
  
    
  }
  function get_request_info(){
    return curl_getinfo($this->ch); 
  }
}
?>
