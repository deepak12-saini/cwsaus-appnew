



<?php
include("../wp-load.php");
$productId = 549;
$product = wc_get_product( $productId );
echo $product->get_title();
echo $product->get_price_html();

$post = get_post( $productId );

echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );

echo $id = get_post_thumbnail_id( $productId );
//echo $data['image'] = wp_get_attachment_url( $id );

///==
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );




print_r($image);
?>

    <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
===		
		<?php

global $product;
global $post;

$attachment_ids = $product->get_gallery_attachment_ids();

echo '<div>';

foreach( $attachment_ids as $attachment_id ) 
{
    echo '<a href="' .wp_get_attachment_image_src( $attachment_id, 'large'). '" rel="shadowbox" >' ."<img src=".wp_get_attachment_image_src( $attachment_id, 'large')." style='width:70px; height:70px;' >". '</a>';
}

echo '</div>';
echo '</div>';

















		session_start();//place this at the top of all code

//include("../wp-load.php");
  $taxonomy     = 'product_cat';
  $orderby      = 'name';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
  );
  

//==========================================
// $current_url = $_SERVER['REQUEST_URI'];
 $current_url ='http://localhost/durotech/product/duromixacs-2/';

 $category_name = explode ('/',$current_url);
  echo '********'.$category_name['5'];
 $newcategory_name = $category_name['5']; 
echo '********';
 $_SESSION['categorynew']=$newcategory_name;
//==========================================

	 $all_categories = get_categories( $args );
	  
	 foreach ($all_categories as $cat) {
		if($cat->category_parent == 0) {
      echo   $category_id = $cat->term_id;  
			
 $newcat = $cat->slug;
			if($newcategory_name==$newcat)
			{
		
			echo '<a  style="background-color:#cccccc;" href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
			} 
			else 
			{ 

		echo '<a  style="background-color:#ffffff;" href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
		

		}
		
		
		
      //  echo '<a  '.$class. 'href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';

        $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
        if($sub_cats) {
            foreach($sub_cats as $sub_category) {
                echo  $sub_category->name ;
            }   
        }
    }       
	}
	echo $retrive_data = WC()->session->get( 'category' );
	?></div>
	<div class="show_allproduct">

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title sandy"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			//do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : echo "XXXXXXXXXXXXX"; ?>
 
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php  echo wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; // end of the loop. ?>
				

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php  echo "CCCCCCCCCCCCC"; wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	

	