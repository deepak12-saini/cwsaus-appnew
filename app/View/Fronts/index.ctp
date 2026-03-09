
<!-- Slick Slider CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<!-- Start Banner -->
<style>
.ErrorField {
    border: 1px solid red !important;
}
.ValidationErrors{ display:none !important; }
.active{ background:#f9a51a!important;} 
.active_new{ background:#f9a51a !important;}
#bannersec {
	height: 600px;
} 

@media only screen and (max-width: 450px) {
#bannersec {
	height: auto !important;
} 
}

/* Slider */
.slick-slide {
  margin: 0px 20px;
}

.logo-carousel {
  overflow: inherit;
 }

.slick-slide img {
  width: 100%;
}

.slick-track::before,
.slick-track::after {
  display: table;
  content: '';
}

.slick-track::after {
  clear: both;
}

.slick-track {
  padding: 1rem 0;
}

.slick-loading .slick-track {
  visibility: hidden;
}

.slick-slide.dragging img {
  pointer-events: none;
}

.slick-loading .slick-slide {
  visibility: hidden;
}

.slick-arrow {
  position: absolute;
  top: 50%;
  background: url(https://raw.githubusercontent.com/solodev/infinite-logo-carousel/master/images/arrow.svg?sanitize=true) center no-repeat;
  color: #fff;
  filter: invert(77%) sepia(32%) saturate(1%) hue-rotate(344deg) brightness(105%) contrast(103%);
  border: none;
  width: 2rem;
  height: 1.5rem;
  text-indent: -10000px;
  margin-top: -16px;
  z-index: 99;
}

.slick-arrow.slick-next {
  right: -40px;
  transform: rotate(180deg);
}

.slick-arrow.slick-prev {
  left: -40px;
}

/* Media Queries */

@media (max-width: 768px) {
  .slick-arrow {
    width: 1rem;
    height: 1rem;
  }
  
}
@media (max-width: 488px) {
   #blogsc{ display:none; }
}
/* JsFiddle Example only/don't use */
.logo-carousel {
  margin-top: 32px;
}

</style>
<section id="">
  <div class="container containers">
	<img class="img-responsive" src="<?php echo SITEURL ;?>front_theme/images/bannerbg.jpg">    
  </div>
</section>
<!-- End Banner --> 

<!-- Start Offers -->
<!--section id="slider">
  <div class="container">
  <h2 style="text-align: center;margin-bottom: 22px;">Our Guarantee</h2>
  <div class="col-md-4 col-sm-6 ofrdtlbnx">
      <div class="ofrdtin">
        <h3>Australian Made & Owned</h3>
        <h5></h5>
        <p>Established In Sydney Australia in year 2000 to help Local companies and customers get excellent service and quality work.</p>
       
		</div>
   </div>
   <div class="col-md-4 col-sm-6 ofrdtlbnx">
      <div class="ofrdtin">
        <h3>Local Manufacturing & Techincal support</h3>
        <h5></h5>
        <p>With Local manufacturing and in house R&D center CWS and Paint world is able to offer the highest level of sale and technical support.</p>
       
		</div>
   </div>
   <div class="col-md-4 col-sm-6 ofrdtlbnx">
      <div class="ofrdtin">
        <h3>6 locations</h3>
        <h5><br/><br/></h5>
        <p>With 6 conveinently located store locations around NSW CWS and Paint world can easily service all your project needs.</p>
       
		</div>
   </div>
  </div>
</section-->
<!-- End slider --> 

<!-- Start About -->
<section id="aboutus">
  <div class="container">
    <div class="title-area">
      <h2 class="title">Welcome To CWS</h2>
      <span></span>
		<p>We Provide Professional Services</p>
	  </div>
    <p><?php
	
		if(strlen($menu['MenuPage']['content']) > 600){
						$strcuting = substr($menu['MenuPage']['content'],0,600).'...';
						echo $strcuting;
						}else{
						echo $menu['descrption']; 
						}
	?></p>
    <a href="<?php echo SITEURL;?>about">Read More</a> </div>
</section>
<!-- End About --> 

<!-- Start Services -->
<section id="services">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Our Key Strengths</h2>
        <span></span> </div>
    </div>
    <div class="servin">
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9s" data-wow-delay="0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/1.branches.png" alt=""/></span>
          <h3>Conveniently located branches</h3>
          
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9s" data-wow-delay="1.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/2.accability.png" alt=""/></span>
          <h3>Accessibility to our people</h3>
          
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="2.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/3.problem solving.png" alt=""/></span>
          <h3>Prompt attention to problem solving</h3>
          
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/4.qauality.png" alt=""/></span>
          <h3>On site quality assurance systems</h3>
          
        </div>
      </div>
	  
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/5.stock.png" alt=""/></span>
          <h3>Large stock holdings</h3>
          
        </div>
      </div> 
	  
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/6.product.png" alt=""/></span>
          <h3>Extensive product ranges</h3>
          
        </div>
      </div>
	  <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/7.warranty.png" alt=""/></span>
          <h3>Fully warranted systems</h3>
          
        </div>
      </div>
	  <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/8.inventory system.png" alt=""/></span>
          <h3>Computerized inventory systems</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/9.delivery time.png" alt=""/></span>
          <h3>Reliable delivery times</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/10.manufacturing.png" alt=""/></span>
          <h3>Local Manufacturing</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	  <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/11.rnd.png" alt=""/></span>
          <h3>Inhouse R&D center</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/12.logistic.png" alt=""/></span>
          <h3>In house logistics and distribution</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	  <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/13.tecgnical team.png" alt=""/></span>
          <h3>Committed and qualified technical and sales team</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	   <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/14.sorcing.png" alt=""/></span>
          <h3>Sourcing of specialized items</br>
            is simply dummy text</h3>
          
        </div>
      </div>
	  <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1.9" data-wow-delay="3.0s">
        <div class="srvdtlsc"> <span><img src="<?php echo SITEURL ;?>front_theme/images/15.training.png" alt=""/></span>
          <h3>Practical & Theoretical Training</br>
            is simply dummy text</h3>
          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Services --> 

<!-- Start right for you -->
<!--section id="rgtfryou">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Is solar right for you?</h2>
        <span></span> </div>
    </div>
    <div class="row">
      <div class="rgtsrin">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc grybg"> <span><img src="<?php echo SITEURL ;?>front_theme/images/rgticn1.png" alt=""/></span>
            <h3>Solar Savings</br>
              Calculator</h3>
            
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc grenbg"> <span><img src="<?php echo SITEURL ;?>front_theme/images/rgticn2.png" alt=""/></span>
            <h3>Solar </br>
              Incentives</h3>
            
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc ylwbg"> <span><img src="<?php echo SITEURL ;?>front_theme/images/rgticn3.png" alt=""/></span>
            <h3>Solar</br>
              Buying Guide</h3>
            
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc blubg"> <span><img src="<?php echo SITEURL ;?>front_theme/images/rgticn4.png" alt=""/></span>
            <h3>Solar for</br>
              Your Business</h3>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section-->
<!-- End Services --> 


<!-- Start gallery -->
<section id="gallery">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Our Product</h2>
        <span></span> 
		<!--p>We Provide Professional Services</p-->
		</div>
    </div>
	
    <div class="row">
	
      <div class="galrywrp">
	  
		<style>
		.tab_service {
			margin-bottom: 30px;
		}
		
		.images {
			background: #fff;
			height: 224px;
			width: 100%;
		}
		.div_right {
			padding: 20px;
			text-align:right;
		}
		.img_left {
			padding: 0px 20px;
			text-align:left;
		}
		.h2_color {
			padding: 0px 20px;
			color: #51a6d1;
			font-weight: 600;
			text-align:left;
		}
		.p_color {
			padding: 0px 20px;
			margin: 0 0 10px;
			text-align:left;
		}
		.
		</style>
		<div class="container_service">
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#F3FAFF;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/bucket.png">
				  </div>
				  <h3 class="h2_color">Liquid Membrane</h3>
				  <p class="p_color">A wide range of Liquid Membrane</p>
			  </div>		
			</div>
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#fff;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/Layer_x0020_1.png">
				  </div>
				  <h3 class="h2_color">Sheet Membrane</h3>
				  <p class="p_color">Best quality sheet membranes.</p>
			  </div>		
			</div>
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#F3FAFF;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/Group 65.png">
				  </div>
				  <h3 class="h2_color">Cementious Membrane</h3>
				  <p class="p_color">Cement Based Membrane</p>
			  </div>		
			</div>
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#fff;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/Group 64.png">
				  </div>
				  <h3 class="h2_color">Flooring</h3>
				  <p class="p_color">Best product for flooring solutions</p>
			  </div>		
			</div>
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#F3FAFF;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/sealant-1.png">
				  </div>
				  <h3 class="h2_color">Sealant</h3>
				  <p class="p_color">A wide range of best quality Sealant</p>
			  </div>		
			</div>
			<div class="col-md-4 tab_service" style="background:#f7f7f7;">
			  <div class="images" style="background:#fff;">
				  <div class="div_right">
					<span class="spn_right"><a style="color:#000;" href="#null">View All</a></span>
				  </div>
				  <div class="img_left">
					<img src="<?php echo SITEURL ;?>front_theme/logo/Page-1.png">
				  </div>
				  <h3 class="h2_color">Adhesives</h3>
				  <p class="p_color">Adhesives products with good adhesion</p>
			  </div>		
			</div>
		</div>

      </div>
    </div>
		  
  </div>
</section>
<!-- End gallery --> 

<!-- Start Blogs -->
<!--section id="blogsc">
  <div class="container">
    <div class="col-md-12">
      <div class="title-area">
        <h2 class="title">Latest news & blog</h2>
        <span></span>
        
      </div>
    </div>
    <div class="clients-brand-area">
      <div class="clients-brand-slide">
	  <?php foreach($Blogs as $Blog){
	  ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="blogsecin">
            <div class="blogim">
			<?php if(!empty($Blog['Blog']['title_image'])){?>
			<img class="img-responsive" src="<?php echo SITEURL ;?>blog_img/<?php echo $Blog['Blog']['title_image']?>"  alt="image">
			<?php }else{?>
			<img class="img-responsive" src="<?php echo SITEURL ;?>front_theme/images/blogimg1.jpg" alt=""/>
			<?php }?>
			</div>
            <div class="blogtxscin">
              <h3> <?php $desc_length=strlen($Blog['Blog']['title']);
									if($desc_length>20)
									{
										$title=substr($Blog['Blog']['title'],0,20).'...';
									}else{
										$title=$Blog['Blog']['title'];
									}
									echo $title;
									?></h3>
            <p><?php $desc_length=strlen($Blog['Blog']['description']);
									if($desc_length>65)
									{
										$description=substr($Blog['Blog']['description'],0,65).'...';
									}else{
										$description=$Blog['Blog']['description'];
									}
									echo $description;
									?></p>
              <ul class="locsc">
                <li><i class="fa fa-cog"></i>  <a class="blog-author" href="<?php echo SITEURL ;?>blog/<?php echo $Blog['Category']['slug']?>"><?php echo $Blog['Category']['name']?></a></li>
                <li><i class="fa fa-calendar"></i> <?php echo date('d M Y',strtotime($Blog['Blog']['created']))?></li>
              </ul>
              <a class="rdbtn" href="<?php echo SITEURL ;?>blogs/detail/<?php echo $Blog['Blog']['slug']?>">Read more</a> </div>
          </div>
        </div>
		<?php } ?>
      </div>
    </div>
  </div>
</section-->
<!-- End Blogs --> 
<!-- Start Clients brand -->
<section id="clients-brand" style="display:none;">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="clients-brand-area">
          <ul class="clients-brand-slide2">
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo1.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo2.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="images/cli-logo3.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo4.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo5.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo6.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo1.png" alt="img"> </div>
            </li>
            <li>
              <div class="single-brand"> <img src="<?php echo SITEURL ;?>front_theme/images/cli-logo2.png" alt="img"> </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Start Blogs -->
<section id="blogsc" style="padding:50px 0px 0px; ">
<div class="container">
<div class="col-md-12">
  <div class="title-area">
	<h2 class="title">Our Brand</h2>
	<span></span>
	
  </div>
</div>
</div>
</section>
<section id="blogsc" style="padding:10px 0px;">
  <div class="container">
	
    <section class="logo-carousel slider" data-arrows="true">
	  <div class="slide"><a href="https://www.ardex.com" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Ardex.jpg'; ?>"><a></div>
	  <div class="slide"><a href="" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Bostik.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://www.bostik.com/australia/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Cosmofin.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://constructionchemicals.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Dribond.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://www.durotechindustries.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/durotech.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://scientificwaterproofingproducts.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Drizoro.jpg'; ?>"><a></div>
	  <div class="slide"><a href="" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Durum.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://elmich.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Elimich.jpg'; ?>"><a></div>
	  <div class="slide"><a href="" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/enviro.jpg'; ?>"><a></div>
	  <div class="slide"><a href="" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/evo.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://gripset.com/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/gripset.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://lauxesgrates.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/lauxes.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://www.parchem.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/parchem.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://aus.sika.com/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Sika.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://soudal.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/Soudal.jpg'; ?>"><a></div>
	  <div class="slide"><a href="https://www.tremco.com.au/" target="_blank"><img src="<?php echo SITEURL.'front_theme/logo/tremco.jpg'; ?>"><a></div>
	 
	</section>
  </div>
</section>
 
<script>
jQuery(function(){ 

$(document).ready(function() {
  $('.logo-carousel').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 6
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
  });
});

$(".fans").fancybox({
	    'transitionIn'	: 'none',
		'transitionOut'	: 'none',
		'titlePosition'	: 'over',
		'onComplete'	: function() {
			$("#fancybox-wrap").hover(function() {
				$("#fancybox-title").show();
			}, function() {
				$("#fancybox-title").hide();
			});
		}
	});
//short for $(document).ready(function(){
$("#fullname").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#email").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#phone").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#address").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});
});


$("#solorhome").click(function() {
	$("#solorhome_1").addClass('active');
	$("#solorbusiness_1").removeClass('active');
	$(".solorhome_1").show();
	$(".solorbusiness_1").hide();
	$("#solortype").val(0);
});		
$("#solorbusiness").click(function() {
	$("#solorbusiness_1").addClass('active');
	$("#solorhome_1").removeClass('active');
	$(".solorhome_1").hide();
	$(".solorbusiness_1").show();
	$("#solortype").val(1);
});	
function systemselection(id){
	$(".ss").removeClass('active');
	$("#ss_"+id).addClass('active');
	$("#system_selection").val(id+'KW');
}

$(".help_me_decide").click(function() {
 var help_me_decide = $("#help_me_decide").val();
 
 if(help_me_decide == 0){
	$(".help_me_decide").addClass('active_new');
	$("#help_me_decide").val(1);
 }else{
	$(".help_me_decide").removeClass('active_new');
	$("#help_me_decide").val(0);
 }
 
});
$("#custom_system_selection").click(function() {
	$(".ss").removeClass('active');
	var custom_system_selection = $("#custom_system_selection").val();
	$("#system_selection").val(custom_system_selection);
});
$(".bckbtn").click(function() {
	$('#part_1').show();	
	$('#part_2').hide();
	$('.bckbtn').hide();
});				
$("#more_check").on("click", function(){
	check = $("#more_check").prop("checked");
	if(check) {
         $('.bckbtn').show();
         $('#part_2').show();
         $('#part_1').hide();
    } else {
        $('#part_1').show();
         $('#part_2').hide();
         $('.bckbtn').hide();
    }
});


</script>
<!-- End Clients brand --> 