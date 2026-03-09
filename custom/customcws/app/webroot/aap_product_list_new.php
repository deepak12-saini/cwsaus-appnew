<?php 
	require('store_app/config.php' );
	
	isset($_POST['category_name'])? $category_name = $_POST['category_name'] : $category_name = 'duromastic-waterbased-membranes';
	
	if(!empty($category_name)){
		$sql = mysqli_query($link,"select * from categories where slug = '". $category_name."'");
		$num  =  mysqli_num_rows($sql);	
		if($num > 0){
			$category_fetch = mysqli_fetch_assoc($sql);
			$category_id = $category_fetch['id'];
			
			$product = mysqli_query($link,"select * from products where category_id = '". $category_id."'");
			$productnum  =  mysqli_num_rows($product);	
			if($productnum > 0){
				$data = array();
				
				
				while($profetch = mysqli_fetch_assoc($product)){
					
					$profetch['image'] = str_replace(" ","%20",$profetch['image']);
					$prodata['productid'] = $profetch['id'];
					$prodata['refer_id']= $profetch['product_code'];
					$prodata['is_image']= $profetch['is_image'];
					$prodata['title']= $profetch['title'];
					$prodata['description'] = $profetch['brief_description'];
					$prodata['link']= $site_url.'products/detail/'.$profetch['slug'];
					$prodata['$project_image'] = $site_url.'productimg/'.$profetch['image'];
					$data[] = $prodata;					
				}	
				//$data['status'] = true;
				//$data['mes'] = $prodataArr;
			}else{
				$data['status'] = false;
				$data['mes'] = 'no products';
			}	
		}else{
			$data['status'] = false;
			$data['mes'] = 'catgory not exist';
		}	
	}else{
		$data['status'] = false;
		$data['mes'] = 'catgory missing';
	}	
	echo json_encode($data);
?>