<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
     <h1>Quick Notes</h1>
      <p>Lorem Ipsum is simply dummy text</p>
     
    </div>
    </div>
</section>
<!-- End Banner --> 

 <!-- Start contact section  -->
  <section id="abtsec">
     <div class="container">
       <div class="row">
       <div class="contcttpsc solrhmwrp">
         <div class="col-md-7 slrhmlfsc">
           <div class="title-area">
              <h2 class="title">Quick Quotes</h2>
             <!--  <span class="line"></span> -->
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
            </div>
            </div>
			<div class="col-md-5 srcfrm slrhmrgtsc">
          
				<h2><?php  echo $QuickQuote['QuickQuote']['title'];?> System</h2>
				<h3><?php  echo $QuickQuote['QuickQuote']['sub_title'];?></h3>
				<p><?php  echo $QuickQuote['QuickQuote']['description'];?></p>
				<div class="frminscwrp">
					<form action="" method="post">
					<input type="hidden" class="form-control" name="id" id="type" value="<?php  echo $QuickQuote['QuickQuote']['id'];?>">
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
								<li><a onclick="systemselection(1)" id="ss_1" class="ss active" href="#">1KW</a></li>
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
jQuery(function(){ //short for $(document).ready(function(){
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
  </script>