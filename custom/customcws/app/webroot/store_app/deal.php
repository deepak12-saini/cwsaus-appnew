<?php
include("../wp-load.php");
$products = get_posts( array(
    'post_type'      => 'deal',
    'posts_per_page' => -1,
    'post_status'    => 'draft'
) );

if ( $products ) {
    foreach ( $products as $post ) {
        setup_postdata( $post );
       $data['product_id'] =   $post->ID;
       $data['title'] =   $post->post_title;
        $id = get_post_thumbnail_id( $post->ID );
        $data['image'] = wp_get_attachment_url( $id );


$data['sub_title'] = get_post_meta( $post->ID ,'sub_title', true);
$data['feature_1'] = get_post_meta( $post->ID ,'feature_1', true);
$data['feature_2'] = get_post_meta( $post->ID ,'feature_2', true);
$data['feature_3'] = get_post_meta( $post->ID ,'feature_3', true);
$data['feature_4'] = get_post_meta( $post->ID ,'feature_4', true);
$data['feature_5'] = get_post_meta( $post->ID ,'feature_5', true);


$data['userarea_1'] = get_post_meta( $post->ID ,'userarea_1', true);
$data['userarea_2'] = get_post_meta( $post->ID ,'userarea_2', true);
$data['userarea_3'] = get_post_meta( $post->ID ,'userarea_3', true);
$data['userarea_4'] = get_post_meta( $post->ID ,'userarea_4', true);
$data['userarea_5'] = get_post_meta( $post->ID ,'userarea_5', true);
$data['userarea_6'] = get_post_meta( $post->ID ,'userarea_6', true);

$data['download_datasheet'] = get_post_meta( $post->ID ,'download_datasheet', true);
$data['download_msds'] = get_post_meta($post->ID ,'download_msds',  true);

$data['product_size'] = get_post_meta( $post->ID ,'product_size', true);
$data['product_price'] = get_post_meta($post->ID ,'product_price',  true);

 $desc=strip_tags($post->post_content);
$descr = preg_replace('!\\r?\\n!', "", $desc);
 
 $data['description'] =$descr;
$res[]= $data;
    }
    wp_reset_postdata();
}

$res1['data'] = $res;
//echo "<pre>"; print_r(array_merge($res1,$res2));
echo json_encode($res1);