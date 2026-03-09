<?php
require('store_app/config.php' );

	isset($_REQUEST['email'])?  $email = $_REQUEST['email'] : $email = '';
	isset($_REQUEST['password'])?  $password = $_REQUEST['password'] : $password = '';
				
	if(!empty($email) && !empty($password)){
		$pass = md5($password);
		$sql = mysqli_query($link,"select * from napp_users where email = '".$email."' and password = '".$pass."'");
		$num  =  mysqli_num_rows($sql);	
		if($num > 0){
			$fetch  =  mysqli_fetch_assoc($sql);
			
			$data['status'] = true;
			$data['user_id'] = $fetch['id'];
			$data['first_name'] = $fetch['name'];
			$data['last_name'] = $fetch['lname'];
			$data['email'] =$fetch['email'];			
		
		}else{
			$data['status'] = false;
			$data['message'] = 'wrong email or password.';
		}
		
	}else{
		$data['status'] = false;
		$data['message'] = 'All parameter required.';
 	}	
	echo json_encode($data); 	
