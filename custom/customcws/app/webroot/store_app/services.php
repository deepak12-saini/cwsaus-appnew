		<?php 

		require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );

		?>


		<?php
		$id=1029;
		$post = get_post($id);
		$mainheading = apply_filters('the_title', $post->post_title);
		

		 $content = apply_filters('the_content', $post->post_content);


	$content1 = explode('<h3 style="color: #2889c9;">', $content);


 foreach($content1 as $key=> $values)
 {
	
	 if($key > 0 )
	 { 
		
	  $getheading1= explode('</h3>', $values);
	
	   $getheading= $getheading1[0];
	  
	   $listing= explode('<li>', $getheading1[1]);
	
		 		 
	  $nlist='';
	  foreach($listing as $key => $nval)
	  {
		  if( $key >0 )
		  {
		
		  $nlisting= explode('</li>', $nval);
			 // echo  $nlisting[0];
			  
		
		  if($nlist=='')
		  {
			 $nlist = $nlisting[0];
		  }
		  else
		  {
			   $nlist = $nlist.'.'. $nlisting[0];
		  }
	  }
	  }
	
		 $service[]= array('mainheading'=> $mainheading,'heading'=>$getheading, 'list'=>$nlist);
		 
	 }
	
 }
echo json_encode($service);
print_R($service);


		?>