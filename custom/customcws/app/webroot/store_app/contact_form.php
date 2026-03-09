<?php
echo "I m working"; 

print_r($_POST);

require("config.php");


	
	$email = trim($_POST['email']);
	
		$subject = trim($_POST['subject']);
		$messages = trim($_POST['message']);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		

	$temData['Error'] ="Invalid email address";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
		die();	
 	}
	else
{

	
	
	$to = 'sam@xoroglobal.com';
  $from = $email;
 $subject= "Durotech app Contact form";
  $headers = "From: " . strip_tags($from) . "\r\n";
  $headers .= "Reply-To: ". strip_tags($from) . "\r\n"; 
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>'; 
$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">'; 
$message .= "<tr><td><img src='http://www.durotechindustries.com.au/store_app/images/wee.png' alt='Durotech' /></td></tr>"; 
$message .= "<tr><td colspan=2>".$messages."</td></tr>"; 
$message .= "</table>"; 
$message .= "</body></html>";
 $result = mail($to, $subject, $message, $headers);
			if($result)
			{
			$temData['msg'] = 'Message Sent Successfully';
			$temData['status'] = '1';
			$data[] = $temData;	
			echo json_encode($data);
			}
			else
			{
					$temData['msg'] = 'Can not send Message';
			$temData['status'] = '0';
			$data[] = $temData;	
			echo json_encode($data);
			}
		
	}
	
	