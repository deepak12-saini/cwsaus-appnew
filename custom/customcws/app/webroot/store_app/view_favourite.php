<?php
require("config.php");
if(sizeof($_POST)>0){
	
	 $userid = trim($_POST['userid']);	
	$sql = "SELECT * FROM add_favourite WHERE user_id = ".$userid."";
	$result = mysqli_query($link,$sql);

			if (@mysqli_num_rows($result) == 0) {
				//echo json_encode(array("Error"=>"$email is not a registered User",'status'=>'1'));
				
				$temData['Error'] ="Item list is empty";
				$temData['status'] = '0';
				$data[] = $temData;
				
				echo json_encode($data);
				
				
			} 
			else 
			{
				if ($row = mysqli_fetch_object($result)) {
					
				
				$temData['id'] = $row->id;
				$temData['user_id'] = $row->user_id;
				$temData['product_id'] = $row->product_id;
				$temData['status'] = $row->status;

				
				$data[] = $temData;
				
				echo json_encode($data);
				}
			
			}
		
		}