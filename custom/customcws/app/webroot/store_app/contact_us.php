<?php
	require("config.php");

	$email = trim($_POST['email']);	
	$name = trim($_POST['name']);
	$number = trim($_POST['number']);
	$messages = trim($_POST['message']);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		

	$temData['msg'] ="Invalid email address";
	$temData['status'] = false;
	$data[] = $temData;
	
	echo json_encode($data);
	die();	
 	}else{	
	
	$to = 'sales@durotechindustries.com.au';
	$from = 'noreply@durotechindustries.com.au';
	$subject= "Durotech app Contact form";
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n"; 
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$message = '<html><body>'; 
	$message .= '<table width="100%"; rules="all" style="border:1px solid #fff;" cellpadding="10">'; 
	$message .= "<tr><td colspan='2'><img src='https://www.durotechindustries.com.au/images/durotech_logo.png' alt='Durotech' /></td></tr>"; 

	$message .= "<tr><td >Name  : </td><td >".$name."</td></tr>"; 
	$message .= "<tr><td >Phone No. : </td><td >".$number."</td></tr>"; 
	$message .= "<tr><td >Email  : </td><td >".$email."</td></tr>"; 
	$message .= "<tr><td >Message  : </td><td >".$messages."</td></tr>"; 

	$message .= "<tr></tr>"; 
	$message .= "<tr><td>Thanks, <br> <br> Durotech Industries</td></tr>"; 

	$message .= "</table>"; 
	$message .= "</body></html>";	
	$result = mail($to, $subject, $message, $headers);
	if($result)
	{
		$temData['msg'] = 'Message Sent Successfully';
		$temData['status'] = true;
		$data[] = $temData;	
		echo json_encode($data);
	}
	else
	{
		$temData['msg'] = 'Can not send Message';
		$temData['status'] = false;
		$data[] = $temData;	
		echo json_encode($data);
	}
		
	}
	
	