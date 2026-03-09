<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
.certificate_container {
	margin: 0 auto;
	width: 62%;
}
.content{ 
padding:20px 0px 5px 82px;
font-size:15px;
font-family:lato,sans-serif;
border: none; 
color:#353535;
} 
@media screen and (min-width: 320px) and (max-width: 640px) {
.content{ 
padding:20px 0px 5px 0px;
font-size:12px;
} 
  .thankyou_container {
	width: 100%;
	margin: 0 auto;
	text-align: center;
}
.certificate_container {
	width: 100%;
}
} 
 </style>
<?php
	$name  = base64_decode(base64_decode($_REQUEST['userid'])); 
?>
</head>
<body>
	<div class="certificate_container">
	   <div class="thanku_page">
		   <img style="width:100%;" src="<?php echo 'https://www.durotechindustries.com.au/wp-content/uploads/' ?>image_cerificate.jpg">
		   <div  class="content"> 
		   <p>This is to certify that <b><?php echo ucfirst($name); ?></b> </p>	   
		  <p> has completed the <span style="color:#0292C4;">CPD Webinar Event</span> with our director Kal Bhinder from Durotech  Industries  </p>		
		   <p>CPD Formal Points awards: 1.0  </p>
		  <p> AACA competence standards: Documention </p></div>	
		   
		   <img style="width:100%;" src="<?php echo 'https://www.durotechindustries.com.au/wp-content/uploads/' ?>refel.jpg">         
	  </div>  
	</div>
</body>
</html>