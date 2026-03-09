<?php
require("config.php");
	$uid=$_POST['userid'];
 if(isset($_FILES['image'])){
      $errors= array();
	 
	   $rand= rand(1,5000000);
       $file_name = $rand.'_'.$_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
     $file_type=$_FILES['image']['type'];
     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
		 
         move_uploaded_file($file_tmp,"uploads/".$file_name);
       
		  $sql = "update napp_user SET profile_pic='"."uploads/".$file_name."' WHERE id = '".$uid."'";
		$result = mysqli_query($link,$sql);
		  if($result)
		  {  
		   
		   $data['status']='1';
		  $data['msg']= "Success";
		  echo json_encode($data);
		  }
		  else
		  {
			   $data['status']='2';
		  $data['msg']= "Success but database not update";
			   echo json_encode($data);
		  }
      }else{
		  
		  $data['status']='0';
		  $data['msg']=$errors;
		  echo json_encode($data);
		 
         
      }
   }