<?php 
	require('store_app/config.php' );
	
	isset($_POST['refer_id'])? $refer_id = $_POST['refer_id'] : $refer_id =  '';
	isset($_POST['user_id'])? $user_id = $_POST['user_id'] : $user_id = 0;
	if(!empty($refer_id)){
	
		$sql = mysqli_query($link,"select * FROM products where product_code = '".$refer_id."'");
		$num = mysqli_num_rows($sql);
		$productList = array();
		if($num > 0){
				$fetch = mysqli_fetch_assoc($sql);
				
				// check product is fav or not 
				if($user_id > 0){
					$exec = mysqli_query($link,'select * from add_favourites where user_id='.$user_id.' and product_id = '.$fetch['id'].' and status = 1');
					$checkfav = mysqli_num_rows($exec);
				}else{
					$checkfav = 0;
				}	
				
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
				
				$datasheet = explode("##",$fetch['datasheet']);
				isset($datasheet[0])? $datasheet_1 = $datasheet[0] : $datasheet_1 = '';
				isset($datasheet[1])? $datasheetdownload_2 = $datasheet[1] : $datasheetdownload_2 = '';
				
				$msds = explode("##",$fetch['msds']);
				isset($msds[0])? $msds_1 = $msds[0] : $msds_1 = '';
				isset($msds[1])? $msds_2 = $msds[1] : $msds_2 = '';
				
				$data['id']= $fetch['id'];
				$data['price']= $fetch['price_dollar'];
				$data['post_title']= $fetch['title'];
				$data['refer_id']= $fetch['product_code'];
				$data['link']= $site_url.'products/detail/'.$fetch['slug'];;
				$data['description'] = $fetch['brief_description'];
				$data['is_image'] = $fetch['is_image'];
				$data['feature'] = $featuresfiles;
				$data['featurelist'] = $featuresfiles;
				$data['usearea'] = $useareas;
				$data['uselist'] = $useareas;
				$data['download'] = rtrim($datasheet_1,' ');
				$data['datasheetdownload_2'] = ltrim($datasheetdownload_2,' ');
				$data['msds']= rtrim($msds_1,' ');
				$data['msdsdownload_2']= ltrim($msds_2,' ');
				$data['vocdownlaod']= $fetch['voc_pdf'];
				$data['project_reference'] = '';
				$data['project_overview'] = '';
				$data['is_favourite']=$checkfav;
				$fetch['image'] = str_replace(" ","%20",$fetch['image']);
				$data['image']= $site_url.'productimg/'.$fetch['image'];
				
				$productdetail['status'] = true;
				$productdetail['datas'] = $data;
		}else{	
			$productdetail['status'] = true;
			$productdetail['message'] = 'No product in favorite list';	
		}	
	}else{
		$data = array();
		$productdetail['status'] = false;	
		$productdetail['datas'] = $data;	
	}	
	echo json_encode($productdetail);
?>	