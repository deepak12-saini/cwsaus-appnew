<?php 

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );


?>

<?php 		
	
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
echo get_categories( $args );

//==========================================
 $all_categories = get_categories( $args );
print_r($all_categories);
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
	
		