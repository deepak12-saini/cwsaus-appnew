<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
/* $sid = $_REQUEST['sid'];
$token  = $_REQUEST['sid'];
$client = new Client($sid, $token);

$to = $_REQUEST['to'];
$from = $_REQUEST['from'];
$message = $_REQUEST['message']; */

$sid = 'AC3f7b3945befee89738e41737a90e5b7e';
$token  = 'a74b0b4e36fc33423725c0dede1702bb';
$client = new Client($sid, $token);

$to = '+61402963688';
$from = '+61488839769';
$message = 'test message';

// Use the client to do fun stuff like send text messages!
$result = $client->messages->create(
    // the number you'd like to send the message to
    $to,
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => $from,
        // the body of the text message you'd like to send
        'body' => $message
    )
);

echo '<pre>';
print_r($result);
die();

?>