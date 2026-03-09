<!-- Start Top section  -->
<section id="calusec" class="slrclcutrmn">
    <div class="container">
		<div class="row">
			<div class="caluttpsc">
				<div class="col-sm-6 col-md-6 contcttpsc_left">
					<div class="quote-text">
						<h2 class="quote-heading">Congratulations!</h2>
						<p class="quote-info">In 25 years, your solar power system could save you
						 </p>
						<h3 class="quote-price">
							<span><strong>up to</strong> Rs</span><div class="result-value"><div class="save-max"><?php echo $calculations['twentyfive_year_saving'] ?></div></div><sup>*</sup>
						</h3>
						<!-- <button type="submit" class="orange-submit-btn" data-toggle="modal" data-target="#emailResults">Send the full report to my email</button> -->
					</div>
					<div class="light-gray-bg"></div>
				</div>
				
				<div class="col-sm-6 col-md-6 contcttpsc_right">
					<div class="gray-bg"></div>
					<div class="clacltrfrmin">
						<div class="row">
							<form method="POST" action="">
								<div class="col-md-6 form-group">
									<label>States</label>
									<select class="form-control" name="data[state_id]" id="state_id">
									<?php foreach($states as $state){ ?>
									<option value="<?php echo $state['State']['state']?>" <?php if($state['State']['state']==$post_data['state_id']) { echo 'selected'; }?>><?php echo $state['State']['state']?></option>
									<?php } ?>
									
								</select>
								</div>
								<div class="col-md-6 form-group">
									<label>Connection Type</label>
									<select class="form-control" name="data[connection_type]" id="connection_type">
									<option value="1" <?php if($post_data['connection_type']==1){ echo 'selected';}?>>Domestic</option>
									<option value="0" <?php if($post_data['connection_type']==0){ echo 'selected';}?>>Commercial</option>
								</select>
								</div>
								<div class="col-md-6 form-group">
									<label>Current electricity bill</label>
									<input type="text" placeholder="" name="data[electricity_bill]" id="electricity_bill" class="form-control" value="<?php echo $post_data['electricity_bill'] ?>">
								</div>
								<div class="col-md-6 form-group">
									<label>Your billing frequency</label>
									<select class="form-control" name="frequency" id="frequency">
									<option  <?php if($post_data['frequency']=='monthly'){ echo 'selected';}?> value="monthly">Monthly</option>
									<option value="bi-monthly" <?php if($post_data['frequency']=='bi-monthly'){ echo 'selected';}?>>Bi-Monthly</option>
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
</section>
<!-- End Top section  -->
  
  <!-- start box  section  -->
  <section id="rgtfryou" class="clnxtbxssc">
  <div class="container">
    <div class="row">
      <div class="rgtsrin">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc grybg"> <span><img src="http://codebrainiacs.com/solar_uncle/front_theme/images/rgticn1.png" alt=""></span>
            <h3>Recommended <br>
              Solar Size</h3>
            <h2 style="color:#fff;"><?php echo number_format($calculations['total_kw_required'], 2) ?> KW</h2>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc grenbg"> <span><img src="http://codebrainiacs.com/solar_uncle/front_theme/images/rgticn2.png" alt=""></span>
            <h3>Monthly <br>
              Savings</h3>
            <h2 style="color:#fff;">Rs. <?php echo round($calculations['monthly_saving'], 2, PHP_ROUND_HALF_DOWN) ?></h2>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc ylwbg"> <span><img src="http://codebrainiacs.com/solar_uncle/front_theme/images/rgticn3.png" alt=""></span>
            <h3>Approx.<br>
              Rebate</h3>
            <h2 style="color:#fff;">Rs. <?php echo round($calculations['total_rebate'], 2,PHP_ROUND_HALF_DOWN) ?></h2>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="rgtsrinsc blubg"> <span><img src="http://codebrainiacs.com/solar_uncle/front_theme/images/rgticn4.png" alt=""></span>
            <h3>ROI<br>
              In <?php echo $calculations['per_year'] ?> Yrs.</h3>
            <h2 style="color:#fff;">ROI = <?php echo $calculations['roi'] ?>%</h2><br>
			<!-- <p> (Return in Investment)</p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- END box section  -->

<section class="frmscninpmn" style="display:none;">
  <div class="container">
    <div class="container">
      <div class="title-area">
        <h2 class="title">Get 3 Solar Power Quotes</h2>
        <p>from installers in your local area</p>
        <span></span> </div>
      <div class="form-area"> 
        
        <!--new steps in tab style-->
        <div class="steps">
          <div class="col-xs-4"><a data-toggle="tab" href="#step1" class="active">Step 1</a></div>
          <div class="col-xs-4"><a data-toggle="tab" href="#step2">Step 2</a></div>
          <div class="col-xs-4"><a data-toggle="tab" href="#step3">Step 3</a></div>
        </div>
        <div class="tab-content slrqtfrmbtnmn">
              <form>
                
                <div class="frmstpsec">
				
                <div id="step1" class="tab-pane fade in active">
                  <div class="col-xs-12">
                    <div class="form-group field-solarform-quotefor">
                      <label class="control-label">What would you like quotes for?</label>
                      <div>
                        <input type="hidden" value="">
                        <div id="solarform-quotefor">
                            <label class="checkbox-inline">
								<input type="checkbox">
								<span>Solar Power System</span>
							</label>
                            <label class="checkbox-inline">
								<input type="checkbox">
								<span>Battery Storage</span>
							</label>
                            <label class="checkbox-inline">
								<input type="checkbox">
								<span>Solar Hot Water</span>
							</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label class="control-label">Do you have an existing solar system?</label>
                      <div>
                        <input type="hidden" value="">
                        <div>
                          <label class="radio-inline">
                            <input type="radio" value="No">
                            <span>No</span></label>
                          <label class="radio-inline">
                            <input type="radio" value="Yes">
                            <span>Yes</span></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label class="control-label">What is your association with this property?</label>
                        <div>
                          <input type="hidden">
                          <div>
                            <label class="radio-inline">
                              <input type="radio" value="Homeowner">
                              <span>Owner</span></label>
                            <label class="radio-inline">
                              <input type="radio" value="Renter">
                              <span>Renting</span></label>
                            <label class="radio-inline">
                              <input type="radio" value="Building">
                              <span>Building</span></label>
                            <label class="radio-inline">
                              <input type="radio" value="Purchasing">
                              <span>Purchasing</span></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="toggleRenting">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">Property Type</label>
                          <div>
                            <input type="hidden">
                            <div id="solarform-rentpropertytype">
                              <label class="radio-inline">
                                <input type="radio" value="House">
                                <span>House</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="Apartment (Strata)">
                                <span>Apartment (Strata)</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">Do you rent your property direct from the owner?</label>
                          <div>
                            <input type="hidden" value="">
                            <div id="solarform-rentfrom">
                              <label class="radio-inline">
                                <input type="radio" value="Yes">
                                <span>Yes</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="No">
                                <span>No – I rent through an agency</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    </div>
					
					
				<div id="step2" class="tab-pane fade in">
				
                    <div class="toggleBuilding">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">What stage are you at in the building process?</label>
                          <div>
                            <input type="hidden" value="">
                            <div>
                              <label class="radio-inline">
                                <input type="radio">
                                <span>Less than 3 months till completion</span></label>
                              <label class="radio-inline">
                                <input type="radio">
                                <span>More than 3 months to completion</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">How long until your roof will be on? </label>
                          <div>
                            <input type="hidden" value="">
                            <div>
                              <label class="radio-inline">
                                <input type="radio" value="Within 6 months">
                                <span>Within 6 months</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="Within 12 months">
                                <span>Within 12 months</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="More than 12 months">
                                <span>More than 12 months</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="togglePurchasing">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">What stage are you at in the purchasing process?</label>
                          <div>
                            <input type="hidden" value="">
                            <div id="solarform-purchasestage">
                              <label class="radio-inline">
                                <input type="radio" value="Within 6 weeks">
                                <span>Within 6 weeks</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="Within 6 - 12 weeks">
                                <span>Within 6 - 12 weeks</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="More than 12 weeks">
                                <span>More than 12 weeks</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="control-label">How long until your property is settled?</label>
                          <div>
                            <input type="hidden" value="">
                            <div id="solarform-purchasesettlementeta">
                              <label class="radio-inline">
                                <input type="radio" value="Within 6 weeks">
                                <span>Within 6 weeks</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="Within 12 weeks">
                                <span>Within 12 weeks</span></label>
                              <label class="radio-inline">
                                <input type="radio" value="More than 12 weeks away">
                                <span>More than 12 weeks away</span></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
				  
				<div id="step3" class="tab-pane fade in">
				
					<div class="detailfrm">
						<p class="frmtxt">These details are required so that each of our suppliers can provide you with accurate quotes for your particular property.</p>
						<div class="qtfrmin">
							<div class="row">
								<div class="col-md-6 form-group">                        
								  <input type="text" placeholder="Your Name" name="name" required="" class="form-control">
								</div>
								<div class="col-md-6 form-group">                        
								  <input type="text" placeholder="Email" name="name" required="" class="form-control">
								</div>
								<div class="col-md-6 form-group">                        
								  <input type="text" placeholder="Phone" name="name" required="" class="form-control">
								</div>
								<div class="col-md-6 form-group">                        
								  <input type="text" placeholder="Address" name="name" required="" class="form-control">
								</div>
								<div class="col-md-12 form-group">                        
								  <textarea placeholder="Note" class="form-control"></textarea>
								</div>
							</div>
						
						</div>	
					</div>	
                    
                    
                </div>
				  
				  
				  
                  </div>
                
                <div class="form-nav">
                  <button type="submit" class="next-section" name="">Get 3 Quotes 
					<span class="glyphicon glyphicon-menu-right"></span>
				  </button>
                </div>
              </form>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <section class="frmscninpmn">
 <div class="row">
	  <div class="col-xs-10 col-xs-offset-1">
 <div id="container" style="width:100%;height:400px;"></div>
  </div>
  </div>
 </section>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
var easeOutBounce = function (pos) {
    if ((pos) < (1 / 2.75)) {
        return (7.5625 * pos * pos);
    }
    if (pos < (2 / 2.75)) {
        return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
    }
    if (pos < (2.5 / 2.75)) {
        return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
    }
    return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
};

Math.easeOutBounce = easeOutBounce;
Highcharts.chart('container', {
    chart: {
        type: 'column',
  
    },

    title: {
        text: 'Savings from installing solar'
    },
    subtitle: {
        text: 'Savings in 25 years'
    },
	 colors: ['#50B432', '#f9a51a'],
    plotOptions: {
        column: {
            depth: 25
        } ,series: {
            colorByPoint: true
        }
    },
    xAxis: {
        categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Years',
        data: [<?php echo $calculations['yearlyinco'];?>]
		,
        animation: {
            duration: 2000,
            // Uses Math.easeOutBounce
            easing: 'easeOutBounce'
        }
    }]
}, function (chart) { // on complete

    chart.renderer.image('https://www.highcharts.com/samples/graphics/sun.png', 100, 100, 30, 30)
        .add();

});



</script>