	<?php
	require("config.php");
	if(sizeof($_POST)>0){

		
		$email = trim($_POST['email']);
		$password = md5(trim($_POST['oldpassword']));
		$newpassword = md5(trim($_POST['newpassword']));
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		//echo json_encode(array("Error"=>"Invalid email address",'status'=>'1'));
		$temData['Error'] ="Invalid email address";
		$temData['status'] = '0';
		$data[] = $temData;
		
		echo json_encode($data);
			die();	
		}
		
		mysqli_query($link,'SET CHARACTER SET utf8');
		
		$sql = "SELECT * FROM napp_user WHERE email = '".$email."' and Password='".$password."'";
	$result = mysqli_query($link,$sql);

	if (@mysqli_num_rows($result) == 0) {
		//echo json_encode(array("Error"=>"$email is not a registered User",'status'=>'1'));
		
		$temData['Error'] ="$email is not found";
		$temData['status'] = '0';
		$data[] = $temData;
		
		echo json_encode($data);
		
		
	} else {
		if ($row = mysqli_fetch_object($result)) {
			
			
		$updatepass = "Update napp_user SET  Password='".$newpassword."' WHERE email = '".$email."' and Password='".$password."'";
	$result_update = mysqli_query($link,$updatepass);
	if($result_update)
	{
		$temData['msg'] = 'Password Updated Successfully';
		$temData['satus'] = '1';
	}
	else
	{
		
		$temData['msg'] = 'can not Updated Password';
		$temData['satus'] = '0';
	}
			
			
		
	
		
		
		
		
	
		$data[] = $temData;
		
		
		
		
		echo json_encode($data);
		}
		
		}
		
		}