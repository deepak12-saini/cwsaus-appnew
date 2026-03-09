<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */


/* ob_start();
	echo "<pre>";		
	print_r($_REQUEST);		
	echo "</pre>";
	$out1 = ob_get_contents();
	ob_end_clean();
	$file = fopen("debug/callog".time().".txt", "w");
	fwrite($file, $out1); 
	fclose($file); */

 
  echo '<?xml version="1.0" encoding="UTF-8"?>
	<Response>
		<Say voice="man" >Thank you for calling Kodex Global Construction Chemicals Your call is important to us. Please hold while we connect your call.</Say>	
		<Pause length="1"></Pause> 
		<Play maxLength="10" timeout="10">http://cwsaus.com.au/twilio/AbeautifulPart.mp3</Play>
		<Say voice="man">All of our agents are currently busy. Please hold and we will answer your call as soon as possible.</Say>	
		<Pause length="1"></Pause> 
		<Play maxLength="10" timeout="10">http://cwsaus.com.au/twilio/AbeautifulPart.mp3</Play>
		<Say voice="man">We are currently experiencing high call volume. Please leave a message with your name and phone number and we will return your call as soon as possible.</Say>	
		<Pause length="1"></Pause> 
		<Play maxLength="10" timeout="10">http://cwsaus.com.au/twilio/AbeautifulPart.mp3</Play>
		<Say voice="man">You have reached the voicemail of Kodex Global Construction Chemicals. Please leave a detailed message and someone will return your call as soon as possible.</Say>	
		<Pause length="1"></Pause> 
		<Play maxLength="10" timeout="10">http://cwsaus.com.au/twilio/AbeautifulPart.mp3</Play>
		<Say voice="man">Thank you for calling Kodex Global Construction Chemicals. We are currently unavailable to take your call. Please leave a message after the beep, or contact us during business hours: Monday through Friday between 9am and 5pm Eastern Standard Time. Thank you! </Say>	
		<Pause length="1"></Pause> 
		<Record action="sendemail.php" maxLength="5"  finishOnKey="*" method="GET" />			
	</Response>'; 
	/*
	$db['hostname'] = 'localhost';
	$db['username'] = 'cwscustom';
	$db['password'] = '5cE2Cx74tJQvD9@1233'; 
	$db['database'] = 'admin_cwscustom';
	$link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
	$From =  $_REQUEST['From'];
	$CallerCountry =  $_REQUEST['CallerCountry'];
	$CallerZip =  $_REQUEST['CallerZip'];

	$CallStatus =  $_REQUEST['CallStatus'];
	$CallSid =  $_REQUEST['CallSid'];
	$Direction =  $_REQUEST['Direction'];

	$ToCountry =  $_REQUEST['ToCountry'];
	$ToState =  $_REQUEST['ToState'];
	$CalledState =  $_REQUEST['CalledState'];
	$date = date('Y-m-d H:i:s');



	mysqli_query($link,"insert into leads(CalledState,FromNumber,CallerCountry,CallerZip,CallStatus,CallSid,Direction,ToCountry,ToState,status,created)values('".$CalledState."','".$From."','".$CallerCountry."','".$CallerZip."','".$CallStatus."','".$CallSid."','".$Direction."','".$ToCountry."','".$ToState."',1,'".$date."')"); */		
 
?>





