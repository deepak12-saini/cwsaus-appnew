<?php
/* 
ob_start();
echo "<pre>";		
print_r($_REQUEST);	
echo "</pre>";
$out1 = ob_get_contents();
ob_end_clean();
$file = fopen("ipn".time().".txt", "w");
fwrite($file, $out1); 
fclose($file); */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../cws/sendgrid/vendor/autoload.php';

$con = mysqli_connect("localhost","cwscustom","5cE2Cx74tJQvD9@1233","admin_cwscustom");
isset($_REQUEST['uniqueid'])? $uniqueid = $_REQUEST['uniqueid'] : $uniqueid = '';
if(!empty($uniqueid)){
	$exec = mysqli_query($con,"select * from rooms where uniqueid = '".$uniqueid."'");
	$num =  mysqli_num_rows($exec);
	if($num > 0){
		$fetch = mysqli_fetch_assoc($exec);
		$name = $fetch['name'];
		$email = $fetch['email'];
		$room = $fetch['room'];
		$fromemail = 'info@cwsaus.com.au';
		$message = '<p>Hi '.$name.',</p>';
		$message .= '<p></p>';
		$message .= '<p>Please connect to this room id: '.$room.' </p>';
		$message .= '<p></p>';
		$message .= '<p>Thanks</p>';
		$message .= '<p>Construction Waterproofing Solutions</p>';
		
		try{
			
			$subject = 'CWS :- Video Call';
			$from = new SendGrid\Email("Construction Waterproofing Solutions: Video Call", $fromemail);
			$to = new SendGrid\Email("Construction Waterproofing Solutions", $email);
			$content = new SendGrid\Content("text/html", $message);		
			$mail = new SendGrid\Mail($from, $subject, $to, $content);	
			
			$apiKey = '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';
			$sg = new \SendGrid($apiKey);
			
			$response = $sg->client->mail()->send()->post($mail); 
			
		}catch(Exception $e){
			
		}
			
	}
}

date_default_timezone_set('Asia/Kolkata');

require_once './vendor/autoload.php'; // Loads the library
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

// Required for Video grant
isset($_REQUEST['room'])? $roomName = $_REQUEST['room'] : $roomName = 'ranjit-'.rand(0000,9999);

$data = array("EnableTurn"=>True,"EnableTurn"=>True,"Type" => "group-small", "UniqueName" => $roomName);
$auth = 'AC146e27a2763786a120535c184598ff02:cdd402727a41d3340c96181a2d87e80e';                                                               
$data_string = json_encode($data);                                                                                
$ch = curl_init('https://video.twilio.com/v1/Rooms');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt( $ch, CURLOPT_USERPWD, $auth ); // authenticate                                                                
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                 
$result = curl_exec($ch);

// Required for all Twilio access tokens
$twilioAccountSid = 'AC146e27a2763786a120535c184598ff02';
$twilioApiKey = 'SK485ab4ed9d1cda16f43a98d0adf255ae';
$twilioApiSecret = 'PhjD1jm0NkesbmaBbxn8V0pz7vQFsAK3';


// An identifier for your app - can be anything you'd like
$identity = rand(0000,9999);

// Create access token, which we will serialize and send to the client
$token = new AccessToken(
    $twilioAccountSid,
    $twilioApiKey,
    $twilioApiSecret,
    36000,
    $identity
);

// Create Video grant
$videoGrant = new VideoGrant();
$videoGrant->setRoom($roomName);

// Add grant to token
$token->addGrant($videoGrant);

// render token to string
echo $token->toJWT();