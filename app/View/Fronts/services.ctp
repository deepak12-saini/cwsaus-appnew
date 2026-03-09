 <!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow fadeInLeft" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Our SERVICES</h1>
           
    </div>
    </div>
</section>
<!-- End Banner -->
 <!-- Start contact section  -->
  <section id="abtsec">
     <div class="container">
       <div class="row">
       <div class="contcttpsc">
         <div class="col-md-12">
           <div class="title-area">
              <h2 class="title">We Provide Professional Services</h2>
              <span class="line"></span>
			  <p>We always offer a collaborative approach and integrated solutions that we tailor to each client`s unique budget and timeline</p>
            </div>
         </div>
		 
		 <div class="servpgwrp">
			<div class="row">
			  <div class="rgtsrin">
								
				 <?php foreach($Gallery as $galleries){?>
					<div class="col-md-12 col-sm-12 wow zoomIn" data-wow-duration="1.9s" data-wow-delay="0s" style="margin-top:20px;">
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<a data-fancybox="gallery" data-caption="<?php echo $galleries['Gallery']['title'];?>" href="<?php echo SITEURL ;?>gallery/<?php echo $galleries['Gallery']['image'];?>" class="fans"><img class="img-responsive" src="<?php echo SITEURL ;?>gallery/<?php echo $galleries['Gallery']['image'];?>" alt=""/></a>
						 </div>
						<div class="col-md-8 col-sm-6 col-xs-12">
						<h4 style="color:#007bc1;"><?php echo $galleries['Gallery']['title'];?> <span class="line"></span></h4>
						<br>
						<div style="text-align: justify;font-size: 14px;">
							<?php echo $galleries['Gallery']['description'];?>
						</div>
						
						</div>				
					</div>
					<br><hr/>
				<?php }?>
				
			  </div>
			</div>
			
		 </div>
		 
		 
		 
		 
		 
        </div>
       </div>
     </div>
  </section>
  <!-- End contact section  -->
