<?php
require( 'store_app/config.php' );

	isset($_REQUEST['user_id'])?  $user_id = $_REQUEST['user_id'] : $user_id = '';
			
	if(!empty($user_id)){
		
		$sql = mysqli_query($link,"select * from napp_users where id = '".$user_id."'");
		$num  =  mysqli_num_rows($sql);	
		if($num > 0){
			$fetch  =  mysqli_fetch_assoc($sql);
			
			$data['id'] = $fetch['id'];
			$data['first_name'] = $fetch['name'];
			$data['last_name'] = $fetch['lname'];
			$data['email'] =$fetch['email'];			
			$data['mobile_number'] =$fetch['mobile_number'];			
			$data['phone'] =$fetch['phone'];			
			$data['fax'] =$fetch['fax'];			
			$data['company'] =$fetch['company'];			
			$data['position'] =$fetch['position'];			
			$data['zipcode'] =$fetch['zipcode'];			
			$data['website'] =$fetch['website'];			
			$data['address_1'] =$fetch['address_1'];			
			$data['address_2'] =$fetch['address_2'];			
			$data['address_3'] =$fetch['address_3'];			
			$data['address_4'] =$fetch['address_4'];			
			$data['address_5'] = $fetch['address_5'];			
			$data['profile_pic'] = 'https://www.durotechindustries.com.au/wp-content/uploads/'.$fetch['profile_pic'];			
		
		}else{
			$data['status'] = false;
			$data['message'] = 'worng user id';
		}
		
	}else{
		$data['status'] = false;
		$data['message'] = 'All parameter required.';
 	}	
	echo json_encode($data); 	
