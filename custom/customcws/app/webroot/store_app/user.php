<?php
require("config.php");
if(sizeof($_POST)>0){
	if(empty($_POST['task']) || empty($_POST['email'])){
		//echo json_encode(array("Error"=>"Empty email or task",'status'=>'1'));
		
	$temData['Error'] ="Empty email or task";
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
	

	switch($_POST['task']){
	case "new":

	if(empty(trim($_POST['mobile_number']))){

         $temData['message'] ="Empty mobile number";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
		//echo json_encode(array("Error"=>"Empty mobile number",'status'=>'1'));
		die();		
	}
	if(empty(trim($_POST['name']))){

      $temData['message'] ="Empty username";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);


		//echo json_encode(array("Error"=>"Empty username",'status'=>'1'));
		die();		
	}
	if(empty(trim($_POST['password']))){

 $temData['message'] ="Empty password";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);


		//echo json_encode(array("Error"=>"Empty password",'status'=>'1'));
		die();		
	}

	$sql = "SELECT * FROM app_user WHERE email = '".$email."'";
	$userChkresult = mysqli_query($link,$sql);

	
	if (@mysqli_num_rows($userChkresult) == 0) {
	$date = date('Y-m-d H:i:s');
	$sql = "INSERT INTO app_user (name, email , password,mobile_number,insert_date) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".md5($_POST['password'])."', '".$_POST['mobile_number']."','".$date."')";
	$result = mysqli_query($link,$sql);
	} else {

        $temData['message'] ="user already registered";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);

	//echo json_encode(array("message "=>"user already registered",'status'=>'1'));
	die();
	}
	
	break;
	case "login":
	
	if(empty($_POST['email']) && empty($_POST['password'])){

$temData['Error'] ="Invalid request data";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);


		//echo json_encode(array("Error"=>"Invalid request data",'status'=>'1'));
		die();
	}
	 $sql = "SELECT * FROM app_user WHERE email = '".trim($_POST['email'])."' and password = '".md5(trim($_POST['password']))."' ";
	$result = mysqli_query($link,$sql);
	if (!$result) {

       $temData['Error'] ="Could not run query";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);


		 //echo json_encode(array("Error"=>"Could not run query",'status'=>'1'));
		exit;
	}
	if (@mysqli_num_rows($result) == 1) {
			$email = $_POST['email'];	
	} else { 

        $temData['message'] ="user not found in database";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);

	//echo json_encode(array("message "=>"user not found in database",'status'=>'1'));
	die(); 
	 }
	break;
	case "change_password":
	
	if(empty($_POST['email']) && empty($_POST['password'])){

         $temData['Error'] ="Invalid request data";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);

		//echo json_encode(array("Error"=>"Invalid request data",'status'=>'1'));
		die();
	}
			$sql = "UPDATE app_user SET password = '".md5(trim($_POST['password']))."' where email = '".$_POST['email']."'";
			$result = mysqli_query($link,$sql);
	 
	break;
	case "forget":
		$sql = "SELECT * FROM app_user WHERE email = '".$_POST['email']."'";
		$result = mysqli_query($link,$sql);
		
		if (@mysqli_num_rows($result) == 1) {
			$email = $_POST['email'];
                        $otp = rand(10,1000000);
                        if(mail($email,"OTP",$otp)){
$mail = "Send";

} else {

$mail = "Not Send";
}
                         
		} else {

                       $temData['message'] ="user not found in database";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);

			//echo json_encode(array("message "=>"user not found in database",'status'=>'1'));
			die();	
		}
		
		break;
		
	
		
	}


$sql = "SELECT * FROM app_user WHERE email = '".$email."'";
mysqli_query($link,'SET CHARACTER SET utf8');
$result = mysqli_query($link,$sql);

if (@mysqli_num_rows($result) == 0) {
	//echo json_encode(array("Error"=>"$email is not a registered User"));
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
	$temData['status'] = '0';
if(!empty($mail)){
$temData['mail'] = $mail;
$temData['otp'] = (string) $otp;
}
	$data[] = $temData;
	
	echo json_encode($data);
	}
	
	}
	} else {
//echo json_encode(array("Error"=>"empty post data",'status'=>'1'));
$temData['Error'] ="empty post data";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);

}
?>