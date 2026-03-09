<?php
	require( 'store_app/config.php' );;
	
	
     // ob_start();
	// echo "<pre>";       
	// print_r($_REQUEST);   
	// echo "</pre>";
	// $out1 = ob_get_contents();
	// ob_end_clean();
	// $file = fopen("debug/request".time().".txt", "w");
	// fwrite($file, $out1);
	// fclose($file);

	isset($_REQUEST['fname'])?  $fname = $_REQUEST['fname'] : $fname = '';
	isset($_REQUEST['lname'])?  $lname = $_REQUEST['lname'] : $lname = '';
	
	isset($_REQUEST['user_id'])?  $user_id = $_REQUEST['user_id'] : $user_id = '';
	isset($_REQUEST['mobile_number'])?  $mobile_number = $_REQUEST['mobile_number'] : $mobile_number = '';
	isset($_REQUEST['phone'])?  $phone = $_REQUEST['phone'] : $phone = '';
	isset($_REQUEST['fax'])?  $fax = $_REQUEST['fax'] : $fax = '';
	isset($_REQUEST['company'])?  $company = $_REQUEST['company'] : $company = '';
	isset($_REQUEST['position'])?  $position = $_REQUEST['position'] : $position = '';
	isset($_REQUEST['zipcode'])?  $zipcode = $_REQUEST['zipcode'] : $zipcode = '';
	isset($_REQUEST['address_1'])?  $address_1 = $_REQUEST['address_1'] : $address_1 = '';
	isset($_REQUEST['address_2'])?  $address_2 = $_REQUEST['address_2'] : $address_2 = '';
	isset($_REQUEST['address_3'])?  $address_3 = $_REQUEST['address_3'] : $address_3 = '';
	isset($_REQUEST['address_4'])?  $address_4 = $_REQUEST['address_4'] : $address_4 = '';
	isset($_REQUEST['address_5'])?  $address_5 = $_REQUEST['address_5'] : $address_5 = '';
	isset($_REQUEST['website'])? $website = $_REQUEST['website'] : $website = '';
				
	if(!empty($fname) && !empty($lname) ){
		
		if(!empty($user_id)){
			
			mysqli_query($link,"update napp_users set name='".$fname."',lname='".$lname."',mobile_number='".$mobile_number."',phone='".$phone."',fax='".$fax."',company='".$company."',position='".$position."',zipcode='".$zipcode."',address_1='".$address_1."',address_2='".$address_2."',address_3='".$address_3."',address_4='".$address_4."',address_5='".$address_5."',website='".$website."' where id='".$user_id."'");	
			
			$data['status'] = true;
			$data['message'] = 'updated successfully';
		}else{
			$data['status'] = false;
			$data['message'] = 'user id is required.';
		}	
	}else{
		$data['status'] = false;
		$data['message'] = 'All parameter required.';
 	}	
	echo json_encode($data); 
?>