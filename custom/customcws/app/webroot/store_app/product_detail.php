<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );


//549

$productId = 1444;
$product = wc_get_product( $productId );
$title =  $product->get_title();
$price = $product->get_price_html();

$post = get_post( $productId );

$description2 = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
 $descriptionx1 = explode('<hr />', $description2);



 $descitions_part1 = $descriptionx1[0];// first description
$desc=strip_tags($descitions_part1);
$descrp = preg_replace('!\\r?\\n!', "", $desc);

 $descitions_part2 = $descriptionx1[1]; // feature section


 $heading_part1 = explode('<strong>', $descitions_part2);// get heading
$feature  = explode('</strong>', $heading_part1[1]); 
$feature_head = $feature[0];


 $li_part1 = explode('<li>',  $descitions_part2);

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


 $descitions_part3 = $descriptionx1[2];// use area

 $heading_part2 = explode('<strong>', $descitions_part3);
$usearea  = explode('</strong>', $heading_part2[1]);
$useareahead =$usearea[0];





 $li_parts1 = explode('<li>',  $descitions_part3);

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
//echo $useareas;



 $descitions_part4 = $descriptionx1[3]; // download area section

 $heading_part4 = explode('<strong>', $descitions_part4);
$downloads  = explode('</strong>', $heading_part4[1]);





 $link_part5 = explode('href="', $descitions_part4);// download link

 $link_parts = explode('"', $link_part5[1]);// download link

$datasheetdownload = $link_parts[0];


 $src_part = explode('src="', $descitions_part4);// download link


 $src_parts = explode('"',$src_part[1]);// download link

$project_reference = $src_parts[0];






 $id = get_post_thumbnail_id( $productId );
//echo $data['image'] = wp_get_attachment_url( $id );

///==
$image1 = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );
$image = $image1[0];

$data['id']=$id;
$data['title']=$title;
$data['price']=$price;
$data['description']=$descrp;
$data['feature']=$feature_head;
$data['featurelist']=$featuresfiles;
$data['usearea']=$useareahead;
$data['uselist']=$useareas;
$data['download']=$datasheetdownload;
$data['project_reference']=$project_reference;


$data['image']=$image;

$res2['datas'] = $data;

		echo json_encode($res2);


?>

    








