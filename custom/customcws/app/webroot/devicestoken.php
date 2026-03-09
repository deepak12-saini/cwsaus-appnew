<?php 

	// include database connection file.
	require('store_app/config.php' );	
	
	isset($_POST['device_token'])? $device_token = $_POST['device_token'] : $device_token = '';
	isset($_POST['device_type'])? $device_type = $_POST['device_type'] : $device_type = '';

	if(!empty($device_token) && !empty($device_type)){
		
		$sql = mysqli_query($link,'select * from devices where device_token="'.$device_token.'" and device_type="'.$device_type.'" ');
		$num = mysqli_num_rows($sql);
		if($num ==  0){
			$date = date('Y-m-d');
			$query =  mysqli_query($link,"insert into devices(device_token,device_type,date) values('".$device_token."','".$device_type."','".$date."')");
		}	
	}	
	
	$data['status'] = true;
	$data['message'] = 'success';

	echo json_encode($data);
			
?>
