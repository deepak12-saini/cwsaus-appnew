<?php
require("config.php");
if(sizeof($_POST)>0){

	
	$email = trim($_POST['email']);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
	//echo json_encode(array("Error"=>"Invalid email address",'status'=>'1'));
	$temData['Error'] ="Invalid email address";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
		die();	
 	}
	
	mysqli_query($link,'SET CHARACTER SET utf8');
	
	$sql = "SELECT * FROM napp_users WHERE email = '".$email."'";
$result = mysqli_query($link,$sql);

if (@mysqli_num_rows($result) == 0) {
	//echo json_encode(array("Error"=>"$email is not a registered User",'status'=>'1'));
	
	$temData['Error'] ="$email this email does not exist";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
} else {
	if ($row = mysqli_fetch_object($result)) {
	

	$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

 for($i = 0; $i < 8; $i++)
 {
     $random_int = mt_rand();
    $password .= $charset[$random_int % strlen($charset)];
 }
 
  $newpassword = $password ;
		
		
		$sqll = "Update napp_user SET password='". md5($newpassword)."' WHERE email = '".$email."'";
		$results = mysqli_query($link,$sqll);
		if($results)
		{
		

		$Name = $row->name;
	$to = $email;
  $from = 'noreply@durotechindustries.com.au';
 $subject= "Durotech Forget Password";
  $headers = "From: " . strip_tags($from) . "\r\n";
  $headers .= "Reply-To: ". strip_tags($from) . "\r\n"; 
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>'; 
$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">'; 
$message .= "<tr><td><img src='https://www.durotechindustries.com.au/images/durotech_logo.png' alt='Durotech' /></td></tr>"; 
$message .= "<tr><td colspan=2>Dear \ $Name  <br /><br />You requeted for new password on durotech app. This is your new password  $newpassword  Please use this password when you login again .</td></tr>"; 
$message .= "<tr><td colspan=2 font='colr:#999999;'><I>Durotech Team<br>Solve your problem. :)</I></td></tr>";  
$message .= "</table>"; 
$message .= "</body></html>";
 mail($to, $subject, $message, $headers);
	
	
	
	
	
	
	
	$temData['msg'] = 'Password Send Successfully';
	$temData['password'] = $newpassword;
	$temData['status'] = '1';
	$data[] = $temData;
	
	
	
	
	echo json_encode($data);
		}
		else
		{
			$temData['msg'] = 'Unbale to Send password';	
	$temData['status'] = '1';
	$data[] = $temData;	
	echo json_encode($data);
		}
	}
	
	}
	
	}