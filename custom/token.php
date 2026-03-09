<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ADD TWILIO REQURIED LIBRARIES
require_once('twilio/Services/Twilio.php');



// TWILIO CREDENTIALS
$TWILIO_ACCOUNT_SID = 'AC146e27a2763786a120535c184598ff02';
$TWILIO_CONFIGURATION_SID = '';
$TWILIO_API_KEY = 'SK605e659d12cbfe61bfad4726f23e5dae';
$TWILIO_API_SECRET = 'LKAYo8TVaawE9U2z4H5V26zsoSfyqt7o';

$authtoken = 'cdd402727a41d3340c96181a2d87e80e';
$twilio = new Services_Twilio($TWILIO_ACCOUNT_SID, $authtoken);

$room = $twilio->video->v1->rooms("ranjitdemo")->fetch();

echo '<pre>';
print_r($room);
print_r($twilio);
die();

// CREATE TWILIO TOKEN
// $id will be the user name used to join the chat
$id = $_GET['id'];

$token = new Services_Twilio_AccessToken(
    $TWILIO_ACCOUNT_SID,
    $TWILIO_API_KEY,
    $TWILIO_API_SECRET,
    3600,
    $id
);

// GRANT ACCESS TO CONVERSTATION
$grant = new Services_Twilio_Auth_ConversationsGrant();
$grant->setConfigurationProfileSid($TWILIO_CONFIGURATION_SID);
$token->addGrant($grant);

// JSON ENCODE RESPONSE
echo json_encode(array(
    'id'    => $id,
    'token' => $token->toJWT(),
));
