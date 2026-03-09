<!-- Start Banner -->
<section id="bannerseciner">
  <div class="container">
    <div class="col-md-12 bnrtxtsecinr wow zoomIn" data-wow-duration="1.8s" data-wow-delay="0.0s">
      <h1>CONTACT US</h1>
      <!--p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p-->
     
    </div>
    </div>
</section>
<!-- End Banner --> 

 <!-- Start contact section  -->
  <section id="contact">
     <div class="container">
       <div class="row">
       <div class="contcttpsc">
         <div class="col-md-12">
           <div class="title-area">
              <h2 class="title">Get In Touch</h2>
              <span class="line"></span>
              <p>You can always reach us through the form on the right, but if you’re ever unsure of something, need more advice, want to ask questions about a product or just need some guidance to get you on the right path, you can also get in touch with us through the details below –</p>
            </div>
         </div>
         <div class="col-md-12">
           <div class="cotact-area">
             <div class="row">
               <div class="col-md-4">
                 <div class="contact-area-left">
                   <h4>Contact Info</h4>
                   <p>Here at CWS World, we are THE CWS store to come to when you need advice. Our team are all trained specialists in Painting, Waterproofing, Marine CWS and Decking and you know you’ll get the right advice to get the job done right the first time</p>
                   <address class="single-address">                    
                     <!--p><i class="fa fa-envelope-o"></i>(02) 9897 0400</p-->
                     <p><i class="fa fa-phone"></i>info@cwsaus.com.au</p>
                   </address> 
                   <div class="footer-right contact-social">
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>                
                 </div>
               </div>
               <div class="col-md-8">
                 <div class="contact-area-right">
                   <form method="post" class="comments-form contact-form">
                    <div class="form-group">                        
                      <input type="text" class="form-control" required  name="data[Contact][name]" placeholder="Your Name">
                    </div>
                    <div class="form-group">                        
                      <input type="email" class="form-control" required placeholder="Email" name="data[Contact][email]">
                    </div>
                     <div class="form-group">                        
                      <input type="text" class="form-control" required placeholder="Subject" name="data[Contact][subject]">
                    </div>
					<div class="form-group">                        
                      <input type="text" class="form-control" required placeholder="Amount" name="data[Contact][amount]" id="amount" onkeypress="checkval();">
                    </div>
                    <div class="form-group">                        
                      <textarea placeholder="Comment" rows="3" required class="form-control"name="data[Contact][message]"></textarea>
                    </div>
                    <button class="comment-btn">Submit Comment</button>
                  </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       </div>
     </div>
  </section>
	<!--section id="slider">
	<div class="container">
		
		<div class="col-md-4 col-sm-6 ofrdtlbnx">
			<div class="ofrdtin">
				<h3 style="font-size:26px">Best Price Gaurantee**</h3>
				<h5>Find a better price online or in store and we’ll beat it by 5%. Conditions apply**</h5>				
			</div>
		</div>
		<div class="col-md-4 col-sm-6 ofrdtlbnx">
			<div class="ofrdtin">
				<h3  style="font-size:26px">Australia Wide Delivery</h3>
				<h5>We can delivery Australia Wide for the best price you’ll find online</h5>				
			</div>
		</div>
	
		<div class="col-md-4 col-sm-6 ofrdtlbnx">
			<div class="ofrdtin">
				<h3  style="font-size:26px">Monthly Specials</h3>
				<h5>Sign up to our newsletter online and be the first to know about our specials</h5>				
			</div>
		</div>
	</div>	
  </section-->
    
  <!-- End contact section  -->

  <!-- Start google map -->
  <!--section id="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.3714257064535!2d-86.7550931378034!3d34.66757706940219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8862656f8475892d%3A0xf3b1aee5313c9d4d!2sHuntsville%2C+AL+35813%2C+USA!5e0!3m2!1sen!2sbd!4v1445253385137" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  </section-->
  <!-- End google map -->
  <script>
  function checkval()
  {
	var amounttext=$('#amount').val();
	var amount = parseFloat(amounttext);
        if (!(/^[-+]?\d*\.?\d*$/.test(amount))){
            alert('Please enter only numbers into amount textbox.')
            document.getElementById('amount').value = "";
        }

  }
  </script>