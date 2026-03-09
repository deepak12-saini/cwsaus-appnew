	<script>
		function search(){			
			var searchPro = $("#searchPro").val();
			if(searchPro != ''){
				$("#formsubmit").submit();
			}else{
				//$("#formsubmit").submit();
				return false;
			}	
		}	
	</script>
	<style>
	.login{ border: 1px solid #2889c9;padding: 6px 8px;border-radius: 14px;color: #2889c9;margin-right: 10px !important;};


	</style>
	<?php
		$searchtitle = $this->Session->read('searchtitle');
	?>
	<div class="header_fixed col-lg-12 col-md-12 col-sm-12">
		<div class="header_top col-lg-12 col-md-12 col-sm-12">
			  
			  <div class="header_top_address col-lg-6 colmd-6 col-sm-6">
				   <ul>
					   <li><Strong>Address:</strong> <?php echo ADDRESS;  ?></li>
					   <li><Strong>Phone:</strong> <?php echo PHONE;  ?></li>
				   
				   </ul>
			  </div>
			  <div class="header_top_social_search col-lg-2 col-md-2 col-sm-2" >
					<form action="<?php echo SITEURL.'products/search' ?>" method="post" id="formsubmit">
						<input type="text" name="data[search]" value="<?php echo $searchtitle; ?>" id="searchPro" placeholder="Search Product" required>
						<a href="javascript:void(0)" onclick="search()"><i  onclick="search()" class="fa fa-search" aria-hidden="true"></i></a>
					</form>			  
			  </div>
			  <div class="header_top_social col-lg-2 col-md-2 col-sm-2">
			   <ul>
					<li><a  target="_blank" href="<?php echo FACEBOOK ?>"><i class="fa fa-facebook" aria-hidden="true"></a></i></li>
					<li><a  target="_blank" href="<?php echo TWITER ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a  target="_blank" href="<?php echo GOOGLE_PLUS ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<li><a  target="_blank" href="https://www.instagram.com/durotechindustries.com.au"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>					   
			   </ul>			  
			</div>
			<div class="header_top_social_login col-lg-2 col-md-2 col-sm-2" >
			<?php
			$is_customer = $this->Session->read('is_customer'); 
			if(empty($is_customer)){		
			?>
				<a href="<?php echo SITEURL.'login'; ?>" class="login">Login </a>					
			
			<a href="<?php echo SITEURL.'register'; ?>" class="login">Register</a>					
			<?php }else{ ?>
				<a href="<?php echo SITEURL.'users/dashboard'; ?>" class="login">Account</a>	
			<?php } ?>	
			</div>
		</div>
		<div class="container example5">
			<nav class="navbar navbar-default">
			<div class="container-fluid">
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar5">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo SITEURL ;?>"><img src="<?php echo SITEURL ;?>customdurotech/images/durotech_logo.png" alt="Dispute Bills">
				</a>
			  </div>
			  <div id="navbar5" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
				  <!--li class="active"><a href="<?php echo SITEURL ?>">Home</a></li-->
				  <li><a href="<?php echo SITEURL ?>">Home</a></li>
				  <li><a href="<?php echo SITEURL ?>about">About Us</a></li>
				  <li><a href="<?php echo SITEURL ?>products">Products</a></li>
				  <li><a href="<?php echo SITEURL ?>technical-literature">Technical literature</a></li>
				  <li><a href="<?php echo SITEURL ?>durooem">DuroToll</a></li>
				  <li><a href="<?php echo SITEURL ?>durolab">DuroLab</a></li>
				  <li><a href="http://durotechpolymers.com">Durotech Polymers</a></li>
				  <li><a href="<?php echo SITEURL ?>contact">Contact Us</a></li>
				</ul>
			  </div>
			  <!--/.nav-collapse -->
			</div>
			<!--/.container-fluid -->
			</nav>
		</div>
	</div>
	