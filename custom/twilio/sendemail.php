<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
echo '<Response></Response>'; // Place the desired response (if any) here.

require '../cws/sendgrid/vendor/autoload.php';
	$senderemail = 'info@cwsaus.com.au';
	
	$subject = "Message from ".$_REQUEST['From']; 
	
	$message = "You have received a message from ".$_REQUEST['From'];
	$message .= "To listen to this message, please visit this URL:  ".$_REQUEST['RecordingUrl'];	
	$to = 'kal@xoroglobal.com';

	try{
	
		$from = new SendGrid\Email("Construction Waterproofing Solutions", $senderemail);
		$to = new SendGrid\Email("Construction Waterproofing Solutions", $to);
		$content = new SendGrid\Content("text/html", $message);
		
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		
		$apiKey = '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';
		$sg = new \SendGrid($apiKey);
		
		$response = $sg->client->mail()->send()->post($mail); 
	}catch(Exception $e){
		echo '<pre>';
		print_r($e);
		die();
	}
	#echo 'success'; 
?>