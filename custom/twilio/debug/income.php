<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */


// ob_start();
	// echo "<pre>";		
	// print_r($_REQUEST);		
	// echo "</pre>";
	// $out1 = ob_get_contents();
	// ob_end_clean();
	// $file = fopen("debug/callog".time().".txt", "w");
	// fwrite($file, $out1); 
	// fclose($file);

 
  echo '<?xml version="1.0" encoding="UTF-8"?>
	<Response>
		<Say voice="man" pause="8">Welcome to CWS please hold and a customer service representative will be with you shortly.</Say>	
	</Response>'; 

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



	mysqli_query($link,"insert into leads(CalledState,FromNumber,CallerCountry,CallerZip,CallStatus,CallSid,Direction,ToCountry,ToState,status,created)values('".$CalledState."','".$From."','".$CallerCountry."','".$CallerZip."','".$CallStatus."','".$CallSid."','".$Direction."','".$ToCountry."','".$ToState."',1,'".$date."')");		
 
?>





