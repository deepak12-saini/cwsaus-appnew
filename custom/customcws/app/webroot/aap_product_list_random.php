<?php 
	require('store_app/config.php' );
	
	$sql = mysqli_query($link,"select * FROM products where status = '1' ORDER BY RAND() LIMIT 0,4");
	$num = mysqli_num_rows($sql);
	$productList = array();
	if($num > 0){
		while($fetch = mysqli_fetch_assoc($sql)){
			
			$li_part1 = explode('<li>',$fetch['feature']);
			$featuresfiles='';
			foreach( $li_part1 as $key =>  $value)
			{
			if($featuresfiles=='')
			{
				if($key > 0)
				{
				 $value1=strip_tags($value);
			$value2 = preg_replace('!\\r?\\n!', "", $value1);
				$featuresfiles = $value2;
				}
			}
			else
			{
					 $value1=strip_tags($value);
			$value2 = preg_replace('!\\r?\\n!', "", $value1);

				$featuresfiles=$featuresfiles.'.'.$value2;
			}
			}
			
			$li_parts1 = explode('<li>', $fetch['userarea']);
			$useareas='';
			foreach( $li_parts1 as $key =>  $value)
			{
			if($useareas=='')
			{
				if($key > 0)
				{
				 $value1=strip_tags($value);
			$value2 = preg_replace('!\\r?\\n!', "", $value1);
				$useareas = $value2;
				}
			}
			else
			{
					 $value1=strip_tags($value);
			$value2 = preg_replace('!\\r?\\n!', "", $value1);

				$useareas=$useareas.'.'.$value2;
			}


			}
			
			$data['id']= $fetch['id'];
			$data['price']= $fetch['price_dollar'];
			$data['is_image']= $fetch['is_image'];
			$data['post_title']= $fetch['title'];
			$data['refer_id']= $fetch['product_code'];
			$data['link']= $site_url.'products/detail/'.$fetch['slug'];;
			$data['description'] = $fetch['brief_description'];
			$data['feature'] = $featuresfiles;
			$data['featurelist'] = $featuresfiles;
			$data['usearea'] = $useareas;
			$data['uselist'] = $useareas;
			$data['download'] = $fetch['datasheet'];
			$data['project_reference'] ='';
			$data['project_overview'] = '';
			$fetch['image'] = str_replace(" ","%20",$fetch['image']);
			$data['image']= $site_url.'productimg/'.$fetch['image'];
			$productList[] = $data;	
		}	
		$datas['status'] = true;
		$datas['datas'] = $productList;
	}else{	
		$datas['status'] = true;
		$datas['message'] = 'no product in favorite list';	
	}	
	echo json_encode($datas);
?>	