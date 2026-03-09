<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC146e27a2763786a120535c184598ff02';
$token = 'cdd402727a41d3340c96181a2d87e80e';
$client = new Client($sid, $token);

// A Twilio number you own with SMS capabilities
$twilio_number = "+17027664612";

// Where to make a voice call (your cell phone?)
$to_number = "+919914130308";

$client = new Client($sid, $token);

// echo '<pre>';
// print_r($client);
// die();

$response = $client->account->calls->create(  
    $to_number,
    $twilio_number,
    array(
        "url" => "http://demo.twilio.com/docs/voice.xml"
    )
);

print $response;

?>