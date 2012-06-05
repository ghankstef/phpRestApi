<?php

/**
 * @file
 * a REST response class to hold the http response headers  and the payload
 * restResponse class takes a restReqeust object in the contructor
 * @author ghank
 */


abstract class restResponse {
  //put your code here
  protected $response;
  protected $info;
  protected $payload;
  protected $http_status;
  protected $content_type;
  
  /**
   *
   * @param restReqeust $rr a restRequest object
   * this function runs the send_request method  of the restRequest - which really  just executes curl_exec  and curl_getinfo 
   */
  function __construct($payload, $info){
    $this->payload = $payload;
    $this->info = $info;
    $this->http_status = $info['http_code'];
    $arr = restResponse::stripContentTypeString($this->info['content_type']);
    $this->content_type = $arr[0];
  }
  
  /**
   * This function will generate than object based on the content type ie, application/json will create a jsonResponse object
   * @param type $info array from php's curl_info
   * @param type $content_type content_type string from curl_info
   * @param type $response_status - complete array returned from curl_info
   * @param type $payload - the payload returned from the request
   * @return a subclass of restResponse
   */
  public static function getInstance($content_type, $payload, $info){
    $application_type = restResponse::stripContentTypeString($content_type);
    switch ($application_type[0]){
      case 'application/json':
        return new jsonResponse($payload, $info);
        break;
   }
  }
  
  
  public static function stripContentTypeString($string){
    return preg_split("/\;/", $string);
  }
    
   public function getContentType() {
    return $this->content_type;
   }
   
   
   function getPayload () {
     return $this->payload;
   }
    
    /**
     * this function returns error meesages  if needed  if http response code is not 200
     *
     */
    public function parseStatus(){
      $statusLevel = intval($this->http_status)/100;
      switch ($this->http_status){
        case 1:
          break;
        case 2:
          break;
        case 3:
          break;
        case 4:
          break;
        case 5:
          break;
         
    }
  }
}

class jsonResponse extends restResponse{
  function __construct($payload, $info) {
    parent::__construct($payload, $info);
  }
  
  
  
}

?>
