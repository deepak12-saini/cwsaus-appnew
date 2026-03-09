<?php
	require('store_app/config.php');

	isset($_REQUEST['fname'])?  $fname = $_REQUEST['fname'] : $fname = '';
	isset($_REQUEST['lname'])?  $lname = $_REQUEST['lname'] : $lname = '';
	isset($_REQUEST['email'])?  $email = $_REQUEST['email'] : $email = '';
	isset($_REQUEST['password'])?  $password = $_REQUEST['password'] : $password = '';
				
	if(!empty($fname) && !empty($lname)  && !empty($email) && !empty($password)){
		
		$sql = mysqli_query($link,"select * from napp_users where  email = '".$email."'");
		$num  =  mysqli_num_rows($sql);	
		if($num == 0){
		
			// register login detail
			$insert_date = date('Y-m-d H:i:s');
			$password = md5($password);
			
	
			$insert = mysqli_query($link,"insert into napp_users(name,lname,email,password,insert_date)values('".$fname."','".$lname."','".$email."','".$password."','".$insert_date."')");	
			
			$data['status'] = true;
			$data['message'] = 'successfully registered';
		}else{
			$data['status'] = false;
			$data['message'] = 'email id is already exist';
		}	
	}else{
		$data['status'] = false;
		$data['message'] = 'All parameter required.';
 	}	
	echo json_encode($data); 
?>