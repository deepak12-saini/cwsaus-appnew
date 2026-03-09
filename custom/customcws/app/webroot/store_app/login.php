<?php
require("config.php");
if(sizeof($_POST)>0){

	
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
	//echo json_encode(array("Error"=>"Invalid email address",'status'=>'1'));
	$temData['Error'] ="Invalid email address";
	$temData['status'] = '0';
	$data[] = $temData;
	
	echo json_encode($data);
		die();	
 	}
	
	mysqli_query($link,'SET CHARACTER SET utf8');
	
	$sql = "SELECT * FROM napp_user WHERE email = '".$email."' and password='".md5($password)."'";
$result = mysqli_query($link,$sql);

if (@mysqli_num_rows($result) == 0) {
	//echo json_encode(array("Error"=>"$email is not a registered User",'status'=>'1'));
	
	$temData['Error'] ="$email or password not correct";
	$temData['status'] = '0';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
} else {
	if ($row = mysqli_fetch_object($result)) {
		
	
	$temData['id'] = $row->id;
	$temData['name'] = $row->name;
	$temData['email'] = $row->email;
	$temData['mobile_number'] = $row->mobile_number;
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	}
	
	}
	
	}