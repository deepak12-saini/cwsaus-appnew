<?php
require("config.php");
mysqli_query($link,'SET CHARACTER SET utf8');

/* if(empty($_POST['reg_id']) || empty($_POST['email'])){
		//echo json_encode(array("Error"=>"Empty email or task",'status'=>'1'));
		
	$temData['Error'] ="Empty email or registration";
	$temData['status'] = '1';
	$data[] = $temData;
	
	echo json_encode($data);
	
		die();
	} */

	
	
	
	
	
	


//$email = trim($_POST['email']);
//$password = trim($_POST['password');
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$name = trim($_POST['name']);
$mobile_number = trim($_POST['mobile_number']);




	


		$emails=isset($email)?$email:"";	
		
		$fname=isset($name)?$name:"";
		$password=isset($password)?$password:"";

		
		
	
		
		if(!empty($emails) && !empty($fname) && !empty($password))
		{	
		
				if (!filter_var($emails, FILTER_VALIDATE_EMAIL) !== false) {
	//echo json_encode(array("Error"=>"Invalid email address",'status'=>'1'));
	
	$temData['Error'] ="Invalid email address";
	$temData['status'] = '0';
	$data[] = $temData;
	
	echo json_encode($data);
	
	
		die();	
 	}
		
		
		
		
		
		
		
		
		$date=date('Y-m-d h:i:s');
		
		$sqls = "INSERT INTO `napp_user` (`id`, `name`, `email`, `password`, `mobile_number`, `insert_date`) 
		VALUES (NULL, '$fname', '$emails', MD5('$password'), '$mobile_number', '$date')";
		
		
		$result_insert = mysqli_query($link,$sqls);
		$registerid = mysqli_insert_id($link);
		
		if($result_insert)
		{
			
			 $update = "update `napp_user` SET registration_id='$registerid'";		
			$result_update = mysqli_query($link,$sqls);
			if($result_update)
			{
			
			$temData['msg'] ="Record inserted Successfully";
			$temData['userid'] =$registerid;
				$temData['status'] = '1';
				$data[] = $temData;
			}
		}
		else
		{
			$temData['msg'] ="Unabale to register";
				$temData['status'] = '0';
				$data[] = $temData;
		}
		
		
	
			echo json_encode($data);
		
		
		}
		else
		{
		$temData['msg'] ="data missing";
				$temData['status'] = '1';
				$data[] = $temData;
	
			echo json_encode($data);
		}
	
				
		
?>