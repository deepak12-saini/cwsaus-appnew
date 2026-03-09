<?php 
	// include database connection file.
	require('store_app/config.php' );
		
	// post parameters
	$user_id = $_POST['user_id'];
	$product_id = $_POST['product_id'];
	
	if(!empty($user_id) &&  !empty($product_id)){
		
		$sqlp = mysqli_query($link,"select * FROM products where product_code = '".$product_id."'");
		$nump  =  mysqli_num_rows($sqlp);	
		if($nump > 0){
			$fetchp = mysqli_fetch_assoc($sqlp);
			$productId = $fetchp['id'];
		}else{
			$productId = 0;	
		}	
		// check if user has already select product 

		$sql = mysqli_query($link,"select * from add_favourites where user_id='".$user_id."' and product_id = '".$productId."'");
		$num  =  mysqli_num_rows($sql);	
		if($num == 0){
			// product added in favorite_product table 				
			$insert = mysqli_query($link,"insert into add_favourites(id,user_id,product_id,status)values('','".$user_id."','".$productId."','1')");	
			if($insert){
				$datas['status'] = true;
				$datas['message'] = 'sucessfully added';		
			}else{
			 
				$datas['status'] = false;
				$datas['message'] =  mysqli_error($link);;		
			}		
							
		}else{
		    $datas['status'] = true;
		   $datas['message'] = 'already added.';	
		}		
				
	}else{
		$datas['status'] = false;
		$datas['message'] = 'productId and userId is required';
	}
	
	echo json_encode($datas);
?>
