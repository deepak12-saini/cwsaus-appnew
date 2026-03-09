<?php
require("config.php");
if(sizeof($_POST)>0){
/* 	if(empty($_POST['email'])){
		//echo json_encode(array("Error"=>"Empty email",'status'=>'1'));
		
		$temData['Error'] ="Empty email address";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
		die();
	} */
	
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
	
	$sql = "SELECT * FROM napp_user WHERE email = '".$email."'";
$result = mysqli_query($link,$sql);

if (@mysqli_num_rows($result) == 0) {
	//echo json_encode(array("Error"=>"$email is not a registered User",'status'=>'1'));
	
	$temData['Error'] ="$email is not a registered User";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
} else {
	if ($row = mysqli_fetch_object($result)) {
		
	
	$temData['id'] = $row->id;
	$temData['name'] = $row->name;
	$temData['email'] = $row->email;
	$temData['mobile_number'] = $row->mobile_number;
	//$temData['profile_pic'] = $row->profile_pic;
	$temData['status'] = '0';
	$data[] = $temData;
	
	echo json_encode($data);
	}
	
	}
	
	}