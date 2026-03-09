<?php 
	// include database connection file.
	require('store_app/config.php' );
		
	$sql = mysqli_query($link,"SELECT * FROM `products` where datasheet != ''");
	
	$datasheetArr = array();
	while($fetch = mysqli_fetch_assoc($sql)){
		
		$voc_pdf  = $fetch['voc_pdf'];		
		$datasheet = explode("##",$fetch['datasheet']);
		isset($datasheet[0])? $datasheet_1 = $datasheet[0] : $datasheet_1 = '';
		isset($datasheet[1])? $datasheetdownload_2 = $datasheet[1] : $datasheetdownload_2 = '';
		
		$msds = explode("##",$fetch['msds']);
		isset($msds[0])? $msds_1 = $msds[0] : $msds_1 = '';
		isset($msds[1])? $msds_2 = $msds[1] : $msds_2 = '';
		
		$fetch['image'] = str_replace(" ","%20",$fetch['image']);
		$product['title'] = $fetch['title'];
		$product['is_image'] = $fetch['is_image'];
		$product['image'] = $site_url.'productimg/'.$fetch['image'];
		$product['download'] = rtrim($datasheet_1,' ');
		$product['datasheetdownload_2'] = ltrim($datasheetdownload_2,' ');
		$product['msds']= rtrim($msds_1,' ');
		$product['msdsdownload_2']= ltrim($msds_2,' ');
		$product['voc_pdf']= ltrim($voc_pdf,' ');
		$datasheetArr[] = $product;
		
	}	
	
	echo json_encode($datasheetArr);
?>
