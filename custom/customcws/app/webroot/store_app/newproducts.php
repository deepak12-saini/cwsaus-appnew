<?php include("./wp-load.php");
					
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
 $current_url = $_SERVER['REQUEST_URI'];

 $category_name = explode ('/',$current_url);
 $newcategory_name = $category_name['3']; 

//==========================================
	 $all_categories = get_categories( $args );
	 foreach ($all_categories as $cat) {
		if($cat->category_parent == 0) {
        $category_id = $cat->term_id;       
   $newcat = $cat->slug;
			if($newcategory_name==$newcat)
			{
			 $category= array("catname"=>get_term_link($cat->slug, 'product_cat'), "catlink"=> $cat->name);
		//	echo '<a  style="background-color:red;" href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
			} 
			else 
			{ 
 $category= array("catname"=>get_term_link($cat->slug, 'product_cat'), "catlink"=> $cat->name);
//echo '<a  style="background-color:white;" href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
		

		}

    /*     $args2 = array(
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
                //echo  $sub_category->name ;
            }   
        } */
    }       
	}
	?>
                   
						<?php  $args = array( 'post_type' => 'product', 'posts_per_page' => 12, 'product_cat' => 'waterbased_membranes', 'orderby' => 'title', 'order' => 'asc');
        $loop = new WP_Query( $args );
        if($loop->have_posts()): while ( $loop->have_posts() ) : $loop->the_post(); global $product;
if (has_post_thumbnail( $loop->post->ID )) 
{ 
 $thumbnail =  get_the_post_thumbnail_url($loop->post->ID, 'shop_catalog'); 
}

$id = $product->id;
 $link=get_permalink( $loop->post->ID );
$title = $product->get_title();
$src= esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID);
$pro_content = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	//$desc = substr($pro_content,0,80);
	
	$desc=strip_tags(substr($pro_content,0,80));
$descr = preg_replace('!\\r?\\n!', "", $desc);
 

	
	
	
	$res[] = array("prodid"=> $id, "title"=>$title,"thumbnail"=>$thumbnail,"src"=>$src,"description"=>$descr,"link"=>$link);
	$res1['data'] = $res;
	?>
		
		
		<?php endwhile; 
		//wp_reset_query(); 
		endif; 
		
		//print_r($prod);
echo json_encode($res1);
		?>
		
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		
		
		<?php 
		
		
		// get all category in wordpress
		
		
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
 $current_url = $_SERVER['REQUEST_URI'];

 $category_name = explode ('/',$current_url);
 $newcategory_name = $category_name['3']; 

//==========================================
	 $all_categories = get_categories( $args );
	 foreach ($all_categories as $cat) {
		if($cat->category_parent == 0) {
        $category_id = $cat->term_id;       
   $newcat = $cat->slug;
			if($newcategory_name==$newcat)
			{
			 $category[]= array("catname"=>get_term_link($cat->slug, 'product_cat'), "catlink"=> $cat->name);		
			} 
			else 
			{ 
			$category[]= array("catname"=>get_term_link($cat->slug, 'product_cat'), "catlink"=> $cat->name);		

			}
		}
	 }
		$res2['datas'] = $category;

		echo json_encode($res2);
		
		
		?>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
