<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'restRequest.php';
require_once 'restResponse.php';
require_once 'restResponseParser.php';
// indicate what kind of rest request we want to make get, post, put or delete
$request = restReqeust::getInstance('get');

// set the base url we want to retrieve
$request->set_base_url('https://twitter.com/statuses/user_timeline.json');

//setup and query string parameters to send and set the full url
$request->set_full_url(array('id' => 'ghankstef'));

// execute  a curl request and get the payload
$payload = $request->send_request();

// get the metadata from the curl request
$info = $request->get_request_info();

// create a resonse object to hold the payload  and metadata such as http status
$response = restResponse::getInstance($info['content_type'], $payload, $info);



// create a restResponseParser object to convert the json or xml to html 
$parser = restResponseParser::getInstance($response->getContentType(), $response->getPayload());

print $parser->parse();   

?>
