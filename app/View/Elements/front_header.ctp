<!-- Start header -->
<style>
.tpsocialicns li a {
    font-size: 13px;   
}
</style>
<header id="header" class="wow slideInDown" data-wow-duration="1.3s" data-wow-delay="0.0s"> 
  <!-- header top search -->
  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <ul class="tpsocialicns">
          <li><a href="<?php echo SITEURL ?>">Newcastle </a> </li>
          <li><a href="<?php echo SITEURL?>">Seven Hills</a>   </li>
          <li><a href="<?php echo SITEURL?>">Wollongong</a>   </li>
          <li><a href="<?php echo SITEURL?>">Melbourne</a>   </li>
          <li><a href="<?php echo SITEURL?>">Canberra </a>   </li>
          <li><a href="<?php echo SITEURL?>">Perth </a>   </li>
          <li><a href="<?php echo SITEURL?>">Queensland</a>   </li>
        </ul>
        <div class="col-xs-4 pull-right">
          <div class="header-contact">
            <ul>
              <!--li>
                <div class="phone"><i class="fa fa-map-marker"></i> <?php echo ADDRESS?></div>
              </li--->
              <li>
                <div class="mail"><a href="#"><i class="fa fa-envelope-o"></i> <?php echo EMAIL?></a></div>
              </li>
              <li>
                <!---div class="phone"><a href="tel:<?php echo PHONE?>"><i class="fa fa-phone"></i> +<?php echo PHONE?></a></div-->
                <!--div class="phone"><a href="sms:<?php echo PHONE?>"><i class="fa fa-phone"></i> +<?php echo PHONE?></a></div-->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- End header --> 
  
  <!-- BEGIN MENU -->
  <section id="menu-area">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header"> 
            <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <!-- LOGO --> 
            <a class="navbar-brand" href="<?php echo SITEURL ;?>"><img src="<?php echo SITEURL ;?>front_theme/images/logo.png" alt="logo"></a> </div>
          <div id="navbar" class="navbar-collapse collapse">
            <!--div class="srchsctp" style="visibility:hidden;">
              <input type="text" placeholder="Search..."/>
              <a href="#"><i class="fa fa-search"></i></a></div-->
			  
            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav" style="margin-top: 13px;">
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='index') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>">Home</a></li>
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='about') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>about">About Us</a></li>
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='products') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>projects">Projects</a></li>
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='suppliers') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>suppliers">Suppliers</a></li>
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='consulting') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>consulting">Consulting</a></li>
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='promotion') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>promotions">Promotions</a></li>
			  
              <!--li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='ourwork') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>ourwork">Our Work</a></li>
			  
                <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='product_partners') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>product-partners">Paint Place Exclusive</a></li>
           
				<li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='services') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>our-services">Our Service</a></li>
				
				<li  class=""><a href="<?php echo SITEURL ;?>user-area">User Area</a></li-->
             
				<!--li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='blog') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>blog">Blog</a></li-->
			  
              <li  class="<?php if ($this->params['controller']=='fronts' && $this->params['action']=='contact') {echo 'active';}?>"><a href="<?php echo SITEURL ;?>contact-us">Contact</a></li>
            </ul>
          </div>
          <!--/.nav-collapse --> 
        </div>
      </div>
    </nav>
  </section>
  <!-- END MENU --> 
</header>
