<style>
.ErrorField {
    border: 1px solid red !important;
}
.ValidationErrors{ display:none !important; }
</style>
<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>Solar Calculator</h1>
      <p>Solar Calculator</p>
     
    </div>
    </div>
</section>
<!-- End Banner --> 

 <!-- Start contact section  -->
  <section id="abtsec" class="slrclcutrmn">
     <div class="container">
       <div class="row">
       <div class="contcttpsc">
         <div class="col-md-12">
           <div class="title-area">
              <h2 class="title">Solar Calculator</h2>
              <span class="line"></span>
              <p>Our online solar calculator can help you answer these questions about solar:</p>
            </div>
			
			<div class="servin clacltrtyltp">
				<div data-wow-delay="0s" data-wow-duration="1.9s" class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
					<div class="srvdtlsc"> <span><img alt="" src="<?php echo SITEURL?>front_theme/images/pig-icon.png"></span>
					   <h3>How much solar can save you?</h3>
					</div>
				</div>
				<div data-wow-delay="1.0s" data-wow-duration="1.9s" class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
					<div class="srvdtlsc"> <span><img alt="" src="<?php echo SITEURL?>front_theme/images/solar-icon.png"></span>
					  <h3>What solar system size to install?</h3>
					</div>
				</div>
				<div data-wow-delay="2.0s" data-wow-duration="1.9" class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
					<div class="srvdtlsc"> <span><img alt="" src="<?php echo SITEURL?>front_theme/images/money-hand-icon.png"></span>
					  <h3>Eligible gov’t incentives you can get?</h3>
					</div>
				</div>
				<div data-wow-delay="3.0s" data-wow-duration="1.9" class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
					<div class="srvdtlsc"> <span><img alt="" src="<?php echo SITEURL?>front_theme/images/install-cost-icon.png"></span>
					  <h3>Your newly estimated electricity bills?</h3>
					</div>
				</div>
				
				<div class="slrtybtmtxt">
					<p>Our Solar Market savings calculator can help provide you with a general idea of what size of solar power system would best suit your home or business. Based on the information you provide, the calculator will present an estimation of system size (in kW) to meet your regular energy needs</p>
                   <p>You can see the immediate savings to your electricity bills, the payback period and the return on your investment. Additionally, you can view savings projected up to twenty years. You can change the system size up and down, then after you've figured out what your total savings would be - click on the orange "Get 3 Free Quotes" button.</p>
				</div>
			</div>
			
			<div class="calclutrfrmmn">
			
				<div class="frmttlsccl">
				<?php echo $this->Session->flash();?>
					<h3>START GETTING YOUR SOLAR ANSWERS</h3>
					<p>Please provide us some information below so we can start</br>calculating your savings.</p>
				</div>
				
				<div class="clacltrfrmin">
					<div class="row">
						<form method="POST" action="<?php echo SITEURL?>final-calculation">
							<div class="col-md-6 form-group">
								<label>States</label>
								<select class="form-control" name="data[state_id]" id="state_id">
									<?php foreach($states as $state){ ?>
									<option value="<?php echo $state['State']['state']?>" <?php if($state['State']['state']=='Punjab') { echo 'selected'; }?>><?php echo $state['State']['state']?></option>
									<?php } ?>
									
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label>Connection Type</label>
								<select class="form-control" name="data[connection_type]" id="connection_type">
									<option value="1">Domestic</option>
									<option value="0">Commercial</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label>Current electricity bill</label>
								<input type="text" placeholder="" name="data[electricity_bill]" id="electricity_bill" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label>Your billing frequency</label>
								<select class="form-control" name="frequency" id="frequency">
									<option value="monthly">Monthly</option>
									<option value="bi-monthly">Bi-Monthly</option>
									<!--<option value="">Quarterly</option>-->
								</select>
							</div>
							<div class="col-md-12 clcultbtn"><button type="submit" class="orange-submit-btn">Calculate My Savings Now</button></div>
						
						</form>
					</div>
				</div>
				
				
			</div>
			
			
			
         </div>
        </div>
       </div>
     </div>
  </section>
    
  <script>
jQuery(function(){ 
	$("#electricity_bill").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});
});
  </script>
  <!-- End contact section  -->