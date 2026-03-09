<?php 

	require('store_app/config.php');
	
	isset($_REQUEST['staff_id'])?  $staff_id = $_REQUEST['staff_id'] : $staff_id = '';

	if(!empty($staff_id)){
	
		$sql = mysqli_query($link,"select * from staffs where  staff_id = '".$staff_id."'");
		$num  =  mysqli_num_rows($sql);	
		if($num > 0){
			$fetch = mysqli_fetch_assoc($sql);
			
			if($fetch['status'] == 1){
				$emp['employe_id'] = $fetch['id'];
				$emp['employe_name'] = $fetch['name'];
				$emp['employe_email'] = $fetch['email'];
				$emp['employe_phone'] = $fetch['phone'];
				$emp['employe_phone'] = $fetch['designation'];
				
				$data['status'] = true;
				$data['data'] = $emp;	
			}else{
				$data['status'] = false;
				$data['message'] = 'Account is not activated';	
			}
		}else{
			$data['status'] = false;
			$data['message'] = 'wrong key';	
		}	
	}else{
		$data['status'] = false;
		$data['message'] = 'Staff id is required';
 	}	
	echo json_encode($data); 

?>