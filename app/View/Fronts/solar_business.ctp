<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
     <h1><?php  echo $menu['MenuPage']['banner_title'];?></h1>
      <p><?php  echo $menu['MenuPage']['banner_sub_text'];?></p>
     
    </div>
    </div>
</section>
<style>
.ErrorField {
    border: 1px solid red !important;
}
.ValidationErrors{ display:none !important; }
</style>
<!-- End Banner --> 
 <!-- Start contact section  -->
  <section id="abtsec">
     <div class="container">
       <div class="row">
       <div class="solrfrbsnswrp">
			<div class="col-md-7 lftbsnsc">
              <h2><?php  echo $menu['MenuPage']['main_title'];?></h2>
			  <p><?php  echo $menu['MenuPage']['content'];?></p>
			</div>
			
			<div class="col-md-5 rgtbsfrmsc">
            
			  <h2>Get 3 commercial solar proposals today.</h2>
			  <p>These details are required so that each of our suppliers can provide you with accurate quotes for your particular property.</p>
			  <form action="" method="post">
			  <div class="bsnsscfrm1" id="part1">
				 <input type="hidden" name="solortype" id="solortype" value="1">
				 <input type="hidden" name="days" id="days" value="1">
				 <input type="hidden" name="system_size" id="system_size" value="1">
				  <input type="hidden" name="system_selection" id="system_selection" value="1">
				  <input type="hidden" name="purchase_option" id="purchase_option" value="1">
				  <div class="form-group">
					<label>Your Current Industry</label>
					<select class="form-control" id="industry" name="industry" >
						<option value="">Please select an industry</option>
						<option value="Agriculture">Agriculture</option>
						<option value="Mining">Mining</option>
						<option value="Manufacturing">Manufacturing</option>
						<option value="Wholesale Trade">Wholesale Trade</option>
						<option value="Retail Trade">Retail Trade</option>
						<option value="Other">Other</option>
					</select>
				  </div>
				  <div class="form-group spcfcsc" id="other_industry" style="display:none;">
					<label>Please specify your industry:</label>
					<input class="form-control" placeholder="" type="text" name="other_industry">
				  </div>
				  
				  <h5>Your Electricity Usage</h5>
				  <div class="form-group">
					<label>Days of Operations</label>
					<ul class="dyoprslct">
						<li onclick="dayselection(1)" id="do_1" class="do active"><a  href="javascript:void(0)" href="#">Mon</a></li>
						<li onclick="dayselection(2)" id="do_2" class="do"><a  href="javascript:void(0)">Tue</a></li>
						<li onclick="dayselection(3)" id="do_3" class="do" ><a href="javascript:void(0)">Wed</a></li>
						<li onclick="dayselection(4)" id="do_4" class="do"><a  href="javascript:void(0)">Thur</a></li>
						<li onclick="dayselection(5)" id="do_5" class="do"><a  href="javascript:void(0)">Fri</a></li>
						<li onclick="dayselection(6)" id="do_6" class="do"><a  href="javascript:void(0)">Sat</a></li>
						<li onclick="dayselection(7)" id="do_7" class="do"><a  href="javascript:void(0)">Sun</a></li>
					</ul>
				  </div>
				  <div class="form-group">
					<label>Electricity Usage in INR/Unit</label>
					<div class="elctrc row">
						<div class="col-sm-6">
							<select class="form-control" id="elec_usage" name="electricity_usage">
								<option value="">Please Select</option>
								<option data-type="Spend in $" value="INR">Spend in INR</option>
								<option data-type="Unit in kW" value="kW">Units in kW</option>
							</select>
						</div>
						<div class="col-sm-6">
							<input class="form-control" placeholder="Usage Amount" type="text" id="elec_usage_amount" name="electricity_usage_amount">
						</div>
					</div>
				  </div>
				  <h5>System Size</h5>
				  <div class="form-group">
					<label>Do you know what size system you are looking for?</label>
					<ul class="dyoprslct">
						<li onclick="systemsizeselection(1)" id="sisy_1" class="sisy active"><a href="javascript:void(0)">Yes</a></li>
						<li onclick="systemsizeselection(2)" id="sisy_2" class="sisy"><a href="javascript:void(0)">No</a></li>
					</ul>
				  </div>
				  <div class="form-group">
					<label>Please select one of the following</label>
					<ul class="syssltbs">
						<li onclick="systemselection(1)" id="ss_1" class="ss active"><a  href="javascript:void(0)">1KW</a></li>
						<li onclick="systemselection(2)" id="ss_2" class="ss"><a  href="javascript:void(0)">2KW</a></li>
						<li onclick="systemselection(3)" id="ss_3" class="ss"><a  href="javascript:void(0)">3KW</a></li>
						<li onclick="systemselection(4)" id="ss_4" class="ss"><a  href="javascript:void(0)">5KW</a></li>
						<li onclick="systemselection(5)" id="ss_5" class="ss"><a  href="javascript:void(0)">7KW</a></li>
						<li onclick="systemselection(6)" id="ss_6" class="ss"><a  href="javascript:void(0)">10KW</a></li>
					</ul>
				  </div>
				  <div class="form-group">
					<label>Are you considering any of these purchase options?</label>
					<ul class="prchoptnslc">
						<li onclick="purchase_options(1)" id="po_1" class="po active"><a href="javascript:void(0)">Capital Purchase</a></li>
						<li onclick="purchase_options(2)" id="po_2" class="po"><a href="javascript:void(0)">Lease</a></li>
						<li onclick="purchase_options(3)" id="po_3" class="po"><a href="javascript:void(0)">PPA</a></li>
						<li onclick="purchase_options(4)" id="po_4" class="po"><a href="javascript:void(0)">Help me decide</a></li>
					</ul>
				  </div>
				   <div class="form-group">
					<label>Note</label>
					<textarea class="form-control" placeholder="Note" name="note"></textarea>
				  </div>
			  
			  </div>
			
				<div class="bsnsscfrm1"  style="display:none" id="part2">
				  <div class="form-group spcfcsc">
					<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name*">
				  </div>
				  <div class="form-group spcfcsc">
					<input type="text" class="form-control" name="email" id="email" placeholder="Email*">
				  </div>
				  <div class="form-group spcfcsc">
					<input type="text" class="form-control"  name="phone"  id="phone" placeholder="Phone*">
				  </div>
				  <div class="form-group spcfcsc">
					<input type="text" class="form-control"   name="address"  id="address"  placeholder="address*">
				  </div>
				  <div class="form-group spcfcsc">
					<input type="text" class="form-control"  name="pincode" id="pincode"  placeholder="Pincode">
				  </div>
				 
			  </div>
				 <div class="bckqutbtns" id="btn1">
					<button type="button" class="btn btn-primary" id="continue_btn">Continue</button>
					
				  </div>
				  <div class="bckqutbtns" id="btn2" style="display:none;">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="submit" class="btn btn-primary bckbtn">Back</button>
				  </div>
			</form>
			
			</div>
			
			
        </div>
       </div>
     </div>
  </section>
  <script>
  jQuery(function(){ 
  
  $('#industry').change(function() {
    var industry_typ=$(this).val();
	if(industry_typ=='Other')
	{
		$("#other_industry").show();
	}else{
		$("#other_industry").hide();
	}
});

$("#industry").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#elec_usage").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#elec_usage_amount").validate({
	 expression: "if (VAL) return true; else return false;",
	message: ""
});$("#fullname").validate({
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

  function dayselection(id){
	$(".do").removeClass('active');
	$("#do_"+id).addClass('active');
	$("#days").val(id);
}

 function systemsizeselection(id){
	$(".sisy").removeClass('active');
	$("#sisy_"+id).addClass('active');
	$("#system_size").val(id);
}

function systemselection(id){
	$(".ss").removeClass('active');
	$("#ss_"+id).addClass('active');
	$("#system_selection").val(id+'KW');
}

function purchase_options(id){
	$(".po").removeClass('active');
	$("#po_"+id).addClass('active');
	$("#purchase_option").val(id);
}

$("#continue_btn").on("click", function(){

	 $('#part2').show();
	 $('#part1').hide();
	 $('#btn2').show();
	 $('#btn1').hide();
});

$(".bckbtn").click(function() {
	$('#part2').hide();
	 $('#part1').show();
	 $('#btn2').hide();
	 $('#btn1').show();
});	
  </script>