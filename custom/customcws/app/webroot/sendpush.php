<?php

	isset($_REQUEST['deviceToken'])? $deviceToken = $_REQUEST['deviceToken'] :$deviceToken = '';
	isset($_REQUEST['message'])? $message = $_REQUEST['message'] :$message = '';
	if(!empty($deviceToken) && !empty($message)){ 
	
		$passphrase = '12345';
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'proPush.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		// Open a connection to the APNS server
		$fp = stream_socket_client(
		// 'ssl://gateway.push.apple.com:2195', $err,  // For development
		'ssl://gateway.push.apple.com:2195', $err, // for production
		$errstr, 1000, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);
		//echo 'Connected to APNS' . PHP_EOL;
		// Create the payload body
		$body['aps'] = array(
		'alert' => trim($message),
		'sound' => 'default'
		);
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));	
	
		// Close the connection to the server
		fclose($fp);
		echo  'success';
	}
	echo 'success';
	
	
?>

	