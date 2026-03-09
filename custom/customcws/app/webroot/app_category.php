<?php
	require('store_app/config.php' );
	
	
	$sql = mysqli_query($link,"select * from categories where status = 1 and is_deteled = 0");
	$num  =  mysqli_num_rows($sql);	
	
	$category = array();
	if($num > 0){		
		while($fetch = mysqli_fetch_assoc($sql)){
			
			$cate['catname'] = $site_url.'product-category/'.$fetch['slug'];
			$cate['catlink'] = $fetch['category_name'];
			$cate['slug'] = $fetch['slug'];
			$category[] = $cate;
		}	
	
	}
	$cateArr['datas'] = $category;
	echo json_encode($cateArr);
	
?>	