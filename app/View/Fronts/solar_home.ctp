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
.srcfrm.slrhmrgtsc {
    background: #07509e;
    box-shadow: none;
}
.srcfrm.slrhmrgtsc .form-group input.form-control, .srcfrm.slrhmrgtsc .form-group textarea.form-control {    
    box-shadow: 0 0 7px #6a7989;
}
.srcfrm.slrhmrgtsc .bckqutbtns button.btn {
    background:#231f20;
    color: #fff;
}
.srcfrm.slrhmrgtsc .bckqutbtns button.btn:hover {
    background: #f9a51a;
}
.srcfrm.slrhmrgtsc .form-group input.form-control, .srcfrm.slrhmrgtsc .form-group textarea.form-control {
    background: #fff none repeat scroll 0 0;  
	
}

.systmslcin label {
    color: #fff;
}
 .active{ background:#f9a51a!important; color:#fff !important;} 
.active_new{ background:#f9a51a!important;}  
</style>

 <!-- Start contact section  -->
  <section id="abtsec">
     <div class="container">
       <div class="row">
       <div class="contcttpsc solrhmwrp">
         <div class="col-md-7 slrhmlfsc">
           <div class="title-area">
              <h2 class="title"><?php  echo $menu['MenuPage']['main_title'];?></h2>
             <!--  <span class="line"></span> -->
              <p><?php  echo $menu['MenuPage']['content'];?></p>
            </div>
            </div>
			<div class="col-md-5 srcfrm slrhmrgtsc">
          
				<h2>Get 3 Solar Quotes</h2>
				<h3>Fast. Free. No obligation to buy</h3>
				<p>These details are required so that each of our suppliers can provide you with accurate quotes for your particular property.</p>
				<div class="frminscwrp">
					<form action="" method="post">
					<div id="part_1">
					  <div class="form-group">
						<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name*">
					  </div>
					  <div class="form-group">
						<input type="text" class="form-control" name="email" id="email" placeholder="Email*">
					  </div>
					  <div class="form-group">
						<input type="text" class="form-control"  name="phone"  id="phone" placeholder="Phone*">
					  </div>
					  <div class="form-group">
						<input type="text" class="form-control"   name="address"  id="address"  placeholder="address*">
					  </div>
					  <div class="form-group">
						<input type="text" class="form-control"  name="pincode" id="pincode"  placeholder="Pincode">
					  </div>
					  <div class="mrinfckbx">
						<label>
						  <input type="checkbox" id="more_check" value="1" name="more_check"/>
						  If you can provide more information</label>
					  </div>
					  </div>
					  <div id="part_2" style="display:none;">
					  <input type="hidden" name="solortype" id="solortype" value="0">
					  <input type="hidden" name="system_selection" id="system_selection" value="1">
					  <input type="hidden" name="help_me_decide" id="help_me_decide" value="0">
					  <div class="solrselctnsec" >
						<ul class="solrslctbs">
							<li id="solorhome"><a id="solorhome_1" class="active" href="javascript:void(0)" >Solar For</br>Home</a></li>
							<li id="solorbusiness"><a id="solorbusiness_1" href="javascript:void(0)" >Solar For</br>Business</a></li>
						</ul>
						<div class="solorhome_1">
						  <div class="systmslcin">
						  <label>System Selection</label>
							<ul class="syssltbs">
								<li><a onclick="systemselection(1)" id="ss_1" class="ss active" href="javascript:void(0)">1KW</a></li>
								<li><a onclick="systemselection(2)" id="ss_2" class="ss" href="javascript:void(0)">2KW</a></li>
								<li><a onclick="systemselection(3)" id="ss_3" class="ss" href="javascript:void(0)">3KW</a></li>
								<li><a onclick="systemselection(4)" id="ss_4" class="ss" href="javascript:void(0)">5KW</a></li>
								<li><a onclick="systemselection(5)" id="ss_5" class="ss" href="javascript:void(0)">7KW</a></li>
								<li><a onclick="systemselection(6)" id="ss_6" class="ss" href="javascript:void(0)">10KW</a></li>
								<li class="cstentsys"><input type="text" maxlength="10" class="form-control" placeholder="" id="custom_system_selection" ></li>
							</ul>
						  </div>
						  
						
						  
						  <div class="decidbtn"><a href="javascript:void(0)" class="help_me_decide">Help me decide</a></div>
						  
						  <div class="form-group">
							<input type="text" class="form-control" name="monthly_power_bill" placeholder="Monthly Power Bill">
						  </div>
						  <div class="form-group">
							<textarea class="form-control" name="note" placeholder="Note"></textarea>
						  </div>
					  </div>
					  <div class="solorbusiness_1">
					  
					  </div>
				  </div>
					  </div>
					  <div class="bckqutbtns">
						<button type="submit" class="btn btn-primary bckbtn" style="display:none;">Back</button>
						<button type="submit" class="btn btn-primary gtqutbtn">Get Quotes Now!</button>
					  </div>
					</form>
				</div>
	   
		  
			</div>
         </div>
        </div>
     </div>
  </section>
  <!-- End contact section  -->
  
  <script>
jQuery(function(){ 

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