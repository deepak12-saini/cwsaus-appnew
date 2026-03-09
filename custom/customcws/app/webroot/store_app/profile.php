<?php
require("config.php");
mysqli_query($link,'SET CHARACTER SET utf8');


$id=$_POST['userid'];
	
	
		$sqls = "select * from `napp_user` where  id=$id";		
		$result_get = mysqli_query($link,$sqls);
		$rows = mysqli_fetch_array($result_get);
	
	


//$email = trim($_POST['email']);
//$password = trim($_POST['password');
$email = trim($rows['email']);
$password = trim($rows['password']);
$name = trim($rows['name']);
$profile_pic = trim($rows['profile_pic']); 
$mobile_number = trim($rows['mobile_number']);

$data=array("id"=>$id, "email"=>$email,"password"=>$password,"name"=>$name,"mobile_number"=>$mobile_number,"profile_pic"=>$profile_pic);


			echo json_encode($data);
		
	
		
		
	
				
		
?>