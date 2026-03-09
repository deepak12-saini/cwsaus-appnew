<?php

require("config.php");

$name = addslashes(trim($_POST['name']));	
$category = addslashes(trim($_POST['category']));
$messages = addslashes(trim($_POST['message']));

if(!empty($name) && !empty($category) && !empty($messages))
{
	$sqls = "INSERT INTO `send_feedback` (`id`, `name`, `category`, `suggestion`) 
	VALUES (NULL, '$name', '$category', '$messages')";			
		$result_insert = mysqli_query($link,$sqls);
		$registerid = mysqli_insert_id($link);
		
		if($result_insert)
		{
			$temData['msg'] ="Send Feedback Successfully";			
			$temData['status'] = '1';
			$data[] = $temData;			
		}
		else{
			
			$temData['msg'] ="Unabale to send feedback";
			$temData['status'] = '0';
			$data[] = $temData;
			
		}
	echo json_encode($data);
}else{	
	$temData['msg'] ="All parameter required";
	$temData['status'] = '0';
	$data[] = $temData;
	echo json_encode($data);	
}
	
	