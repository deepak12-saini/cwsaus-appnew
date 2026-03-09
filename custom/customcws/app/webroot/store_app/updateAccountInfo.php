<?php
require("config.php");
if(sizeof($_POST)>0){
	if(empty($_POST['email'])){
		//echo json_encode(array("Error"=>"Empty email",'status'=>'1'));
		
		
		$temData['Error'] ="Empty email address";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
		die();
	}
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
	
	$sql = "UPDATE app_user SET mobile_number = '".trim($_POST['mobile_number'])."' , name = '".trim($_POST['name'])."' ,  email = '".$_POST['email']."' where id = '".$_POST['id']."'";
	$result = mysqli_query($link,$sql);
	//echo json_encode(array("message"=>"data update sucessfully",'status'=>'0'));
	 $temData['message'] ="data update sucessfully";
	$temData['status'] = '0';
	$data[] = $temData;
	
	echo json_encode($data);
	}