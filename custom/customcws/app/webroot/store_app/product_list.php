<?php 

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );

?>

  <?php  
$catgory=$_POST['category_name'];
    $args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'product_cat' => $catgory );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post(); 
    global $product; 
 $postid = $loop->post->ID;
 $link = get_permalink();
 $image = woocommerce_get_product_thumbnail();
 $title=  get_the_title();

$post = get_post( $postid );
 $description2 = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

 $descriptionx1 = explode('<hr />', $description2);
 $descitions_part1 = $descriptionx1[0];// first description
$descn=strip_tags($descitions_part1);
$descrpn = preg_replace('!\\r?\\n!', "", $descn);


$src_part = explode('src="', $image);// image path

 $src_parts = explode('"',$src_part[1]);// image pathend

$project_image = $src_parts[0];

$data['productid']=$postid;
$data['title']=$title;
$data['description']=$descrpn;
$data['link']=$link;
$data['$project_image']=$project_image;


$datas[]=$data;

 //echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
    endwhile; 
//print_r($datas);

    wp_reset_query(); 
echo json_encode($datas);
?>


  

