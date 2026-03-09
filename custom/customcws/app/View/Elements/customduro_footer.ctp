<footer>
    <div class="footer_section col-lg-12 col-md-12 col-sm-12">
	    <div class="row">
	     <div class="footer_about col-lg-3 col-md-3 col-sm-3">
		      <img src="<?php echo SITEURL ;?>customdurotech/images/durotech_logo.png">
			  <h6>About Durotech industries is a leading manufacturer and supplier of waterproofing products. Durotech waterproofing products have been widely used in the construction industry for the sealing of wet areas, decks, roofs and other substrates providing protection against moisture and weather damage for over 40 years.</h6>	 
		 </div>
		 
		 <div class="footer_company col-lg-3 col-md-3 col-sm-3">
		      <h4>Our Company</h4>
			  <ul>
			      <li><a href="<?php echo SITEURL ;?>technical-literature">Case studies</a></li>
				  <li><a href="<?php echo SITEURL ;?>wp-content/uploads/Durotech_Credit Application_Term_and_condition.pdf">Terms & Conditions of Use</li>
				  <!--li><a href="<?php echo SITEURL ;?>">Privacy Policy</li-->
				  <li><a href="<?php echo SITEURL ;?>specification">Specifications</li>
				  <li><a href="<?php echo SITEURL ;?>about">Our Mission</li>
				  <li><a href="<?php echo SITEURL ;?>video">Video Gallery</li>
				  <li><a href="<?php echo SITEURL ;?>durotech-institute-of-waterproofing">Durotech Institute of Waterproofing</li>
				  <!--li><a href="<?php echo SITEURL ;?>">Jobs</li-->
		      </ul>
		 </div>
		 
		 <div class="footer_links col-lg-3 col-md-3 col-sm-3">
		     <h4>Quick Links</h4>
			 <ul>
			      <li><a href="<?php echo SITEURL ;?>wp-content/uploads/Durotech_Credit_Application_Form.pdf">Credit Application Form</li>
				  <li><a href="<?php echo SITEURL ;?>wp-content/uploads/Product_warranty_request_form.pdf">Product warranty request form</li>
				  <li><a href="<?php echo SITEURL ;?>products/index/duromastic-waterbased-membranes">Water Based Membranes</li>
				  <li><a href="<?php echo SITEURL ;?>products/index/duroproof-solvent-based-membranes">Solvent based membranes</li>
				  <li><a href="<?php echo SITEURL ;?>products/index/duroprime-primers">Duroprime Primers</li>
				  <li><a href="<?php echo SITEURL ;?>flake">DuroFlake</li>
				  <li><a href="<?php echo SITEURL ;?>faqs">FAQ</li>
		      </ul>
		 
		 
		 </div>
		 
		 <div class="footer_info col-lg-3 col-md-3 col-sm-3">
		     <h4>Contact Information</h4>
			 <ul>
			      <li><i class="fa fa-map-marker" aria-hidden="true"></i><a href="<?php echo SITEURL.'contact' ;?>"><?php echo ADDRESS;  ?></a></li>
				  <li><i class="fa fa-phone" aria-hidden="true"></i><a href="<?php echo SITEURL.'contact' ;?>"><?php echo PHONE;  ?></a></li>
				  <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="<?php echo SITEURL.'contact' ;?>"><?php echo MAILTO;  ?></a></li>
		      </ul>
			  
		    <form id="formemailnews">
		    <div class="form-group">
				<input type="email" class="form-control" id="emailnews" placeholder="Subscribe">
				 <h6 id="successmesg"></h6>
				
			</div>
			<div class="button-4">
				<div class="eff-4"></div>
				<a onclick="subscribe()"> SEND </a>
			</div>
			</form>
			<div class="row">
				<a href="https://play.google.com/store/apps/details?id=com.xoro.durotech&hl=en"><img src="<?php echo SITEURL ?>android-app-icon.png" style="width:80px !important; margin-left:5px"></a>
				<a href="https://itunes.apple.com/us/app/durotech/id1262728802?mt=8"><img src="<?php echo SITEURL ?>AppStore_Download.png" style="width:92px  !important; margin-left:5px"></a>		 
			</div>
		 </div>
         </div>
    </div>
	<div class="footer_bottom col-lg-12 col-md-12 col-sm-12">
	    <a href="<?php echo SITEURL ?>">www.durotechindustries.com.au</a> © 2015-2018. All Rights Reserved
	</div>
</footer>
<script>
	function subscribe(){	
		var emailnews = $("#emailnews").val();		
		if(emailnews != ''){
			
			$.ajax({url: "<?php echo SITEURL.'fronts/subscribe?email='?>"+emailnews, success: function(result){
				$("#emailnews").val('');
				$("#successmesg").html(result);
				setTimeout(function(){ $("#successmesg").html('');}, 5000);
			}});
			
		}else{
			$("#formemailnews").submit();
		}	
	}

	jQuery(function(){ //short for $(document).ready(function(){
	$("#emailnews").validate({
		 expression: "if (VAL) return true; else return false;",
		message: "Please enter email"
	});jQuery("#emailnews").validate({
		expression: "if (VAL.match(\/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$\/) && VAL) return true; else return false;",
		message: "Please enter valid email"
	});
	});

	</script>		