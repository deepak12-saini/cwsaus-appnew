<?php
require("config.php");
mysqli_query($link,'SET CHARACTER SET utf8');

$userid = trim($_POST['userid']);
$productid = trim($_POST['productid']);
$status = '1';




if(!empty($userid)&& !empty($productid))
{	
		$sqls = "INSERT INTO `add_favourite` (`id`, `user_id`, `product_id`, `status`)
		VALUES (NULL, '$userid', '$productid', '1');";		
		
		$result_insert = mysqli_query($link,$sqls);
		$registerid = mysqli_insert_id($link);
		
		if($result_insert)
		{
			$temData['msg'] ="Add to favourite Successfully";
			$temData['userid'] =$userid;
				$temData['status'] = '1';
				$data[] = $temData;
				
		}
		else{
			
			$temData['msg'] ="Unabale to register";
				$temData['status'] = '0';
				$data[] = $temData;
			
		}
	echo json_encode($data);
}
else
{
	
			$temData['msg'] ="productid or userid is empty";
				$temData['status'] = '0';
				$data[] = $temData;
				echo json_encode($data);
	
	
	
	
}
	


	
				
		
?>