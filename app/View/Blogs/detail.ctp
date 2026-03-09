<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>BLOG</h1>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
     
    </div>
    </div>
</section>
<!-- End Banner --> 

 <!-- Start Blog section  -->
  <section id="abtsec">
     <div class="container">
       <div class="row">
       <div class="blgpgwprsc">
            <div class="row">
              <div class="col-md-8">
                <div class="blog-archive-left">
				<?php  if(!empty($Blog)){
							
							?>
                  <!-- Start blog news single -->
                   <article class="blog-news-single">
                    <div class="blog-news-img">
					<div class="pstdate"><?php echo date('d M',strtotime($Blog['Blog']['created']))?></div>
                      <img class="img-responsive" src="<?php echo SITEURL ;?>blog_img/<?php echo $Blog['Blog']['title_image']?>"  alt="image">
                    </div>
                    <div class="blgtlscmn">
						<div class="col-md-6 blog-news-title">
						  <h2><a href="<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>"><?php echo $Blog['Blog']['title']?></a></h2>
						  <p> <a class="blog-author" href="<?php echo SITEURL ;?>blog/<?php echo $Blog['Category']['slug']?>"><?php echo $Blog['Category']['name']?></a><span class="divider">I</span><span class="blog-date"><?php echo date('d M Y',strtotime($Blog['Blog']['created']))?></span></p>
						</div>
						<div class="col-md-6 footer-right contact-social soclicnshr">
						  <a href="http://www.facebook.com/sharer.php?u=<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>" target="_blank"><i class="fa fa-facebook"></i></a>
						  <a href="https://twitter.com/share?url=<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>" target="_blank"><i class="fa fa-twitter"></i></a>
						  <a href="https://plus.google.com/share?url=<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
						  <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						</div>
                    </div>
                    <div class="blog-news-details">
                      <?php	echo $Blog['Blog']['description']; 	?>
                    </div>
                  </article>
				  <?php }else{?>
				  No Post
				  <?php }?>
				 
                  
                </div>

              </div>
              <div class="col-md-4">
                <aside class="blog-side-bar">
                  <!-- Start sidebar widget -->
                  <div class="sidebar-widget">
                    <!-- Start blog search -->
                    <form>                    
                      <div class="search-group">                        
                        <input placeholder="Search" type="search">
                        <button type="button" class="blog-search-btn"><span class="fa fa-search"></span></button>
                      </div>                    
                    </form>
                    <!-- End blog search -->                                
                  </div>
                  <!-- Start sidebar widget -->
                  <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="widget-catg">  
						<?php if(!empty($categories)){
						foreach($categories as $category)
						{
						?>                    
                      <li><a href="<?php echo SITEURL ;?>blog/<?php echo $category['slug']?>"><?php echo $category['name']?> (<?php echo $category['count']?>)</a></li>
                      <?php }}else{?>
							<li><a href="#">No Category</a></li>
							<?php }?>
                    </ul>
                  </div>
				  <div class="sidebar-widget">
                    <h4 class="widget-title">Recent Post</h4>
                    <ul class="widget-catg">                      
                      <?php if(!empty($RecentBlogs)){
									foreach($RecentBlogs as $RecentBlog)
									{
							?>
							 <li>
								<a href="<?php echo SITEURL ;?>blogs/detail/<?php echo $RecentBlog['Blog']['slug']?>"><?php echo $RecentBlog['Blog']['title']?></a>
                                
                            </li>
							<?php }}else{?>
							<li><a href="#">No Post</a></li>
							<?php }?>
                    </ul>
                  </div>
<!-- 				  <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="widget-catg">                      
                      <li><a href="#">Lorem Ipsum is simply dummy text</a></li>
                      <li><a href="#">Lorem Ipsum is</a></li>
                      <li><a href="#">Lorem Ipsum is simply</a></li>
                      <li><a href="#">Lorem</a></li>
                      <li><a href="#">Lorem Ipsum is simply dummy</a></li>
                    </ul>
                  </div> -->
                  
                  
                </aside>
              </div>
            </div>
          
		 
		 
		</div>
       </div>
     </div>
  </section>
  <!-- End Blog section  -->
