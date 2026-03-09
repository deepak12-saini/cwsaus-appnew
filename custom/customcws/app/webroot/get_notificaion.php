<?php 
	// include database connection file.
	require('store_app/config.php' );	

		// check if user has already select product 

		$sql = mysqli_query($link,"select * from notifications order by id desc");
		$num  =  mysqli_num_rows($sql);	
		if($num > 0){
			
			$notificatiionArr = array();
			while($fetch = mysqli_fetch_assoc($sql)){
				
				if(!empty($fetch['product_id'])){
					$sqlp = mysqli_query($link,"select * from products where id=".$fetch['product_id']."");
					$fetchp = mysqli_fetch_assoc($sqlp);
					$data['refer_id'] = $fetchp['product_code'];
				}else{
					$data['refer_id'] = '';
				}	
				
				
				$data['id'] = $fetch['id'];
				$data['type'] = $fetch['type'];				
				$data['title'] = $fetch['title'];
				$data['description'] = $fetch['description'];
				
				if(!empty($fetch['image'])){
					$data['image'] = $site_url.'product_image/'.$fetch['image'];
				}else{
					$data['image'] = '';	
				}	
			
				$data['created'] = $fetch['created'];
				$notificatiionArr[] = $data;
			}		
			$datas['status'] = true;
			$datas['message'] = $notificatiionArr;				
		}else{
		    $datas['status'] = true;
			$datas['message'] = 'No notification.';	
		}		
					
	echo json_encode($datas);
?>
