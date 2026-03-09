<!DOCTYPE html>
<html lang="en">
<head>
  <title>Construction Waterproofing Solutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

require 'sendgrid/vendor/autoload.php';
$success = '';
	if(isset($_POST['submit'])){
		
	if(!empty($_POST['inserIndivdualtname'])){
	for($i=0; $i<count($_POST['inserIndivdualtname']); $i++){
		
	$inserIndivdualtname = $_POST['inserIndivdualtname'][$i];
	$insertcompanyname = $_POST['insertcompanyname'][$i];
	$insertbuildersname = $_POST['insertbuildersname'][$i];
	$projectname = $_POST['projectname'][$i];
	$date = date('d/m/Y',strtotime($_POST['date'][$i]));
	$insertname = $_POST['insertname'][$i]; 
	$senderemail = $_POST['senderemail'][$i]; 
	if(!empty($_POST['subject'][$i])){
		$subject = $_POST['subject'][$i]; 
	}else{
		$subject = 'CWS :- Waterproofing and Epoxy Flooring'; 
	}
	
	

	$message = '<div class="certificate_container" style="width: 90%; margin: 0 auto;">
	   <div class="thanku_page">
		   <img style="width:100%;" src="http://cwsaus.com.au/cws/Email_letter_11.png">
		    <div  class="content" style="padding:20px 0px 5px 10px;font-size:14px;font-family:lato,sans-serif;border: none; color:#353535; z-index: -999999;margin-top: -41px;margin-left:10px;margin-right: 20px;" > 
		    <p>Attn: '.$inserIndivdualtname.'</p>
			<p>Company: '.$insertcompanyname.'</p>
			<p>Project Name: '.$projectname.'</p>
			<p>Specification: Waterproofing and Epoxy Flooring</p>
			<p>Email: '.$insertbuildersname.'</p>
			<p style="margin-bottom:40px">Date: '.$date.'</p>
			

			<p style="margin-bottom:10px">Dear '.$insertname.',</p>
			
		
			<p style="text-align:;">On behalf of Construction Waterproofing Solutions (CWS), we are writing to express our interest in providing detailed product specifications and quotations for supply and installation for the waterproofing and Epoxy Flooring for the following project ('.$projectname.') and projects you have coming up immediately or in the future.</p>
			
			<p style="text-align:;">Construction Waterproofing Solutions is a services company which has expertise in All areas of epoxy flooring and all kinds of waterproofing solutions for a Commerical and residential project.</p>
			
			<p style="text-align:;">At Construction Waterproofing Solutions, we have a combined experience of over 100 years. With offices located all around Australia, we are strongly becoming a preferred choice for both Domestic and National Builders. CWS basic purpose is to install product systems that surpass the highest of expectations In the market.</p>
			
			<p style="text-align:;">We constantly monitor our supplied products and strive to improve our services. The products used by CWS are preferred for their blend of superior performance and track record. Our quality processes are designed to ensure the maintenance of the product quality through evaluation, inspection and verification processes at all stages of installation.</p>
			
			<p style="text-align:;">We are committed to complying with the customer and statutory requirements and are dedicated towards continual improvement of our quality management system in order to achieve a level of quality that enhances our reputation with our customers.</p>
			
			<p style="text-align:;">All products we use are tested both through Australian Standard and the Manufacturers Standards. Being an approved Installer of some of the largest construction chemical manufacturers in Australia sets us apart from the rest of the companion. Gaining Valuable insights into Innovation and technology while getting full support and backing from the product suppliers them selfs.</p>
			
			<p style="text-align:;">CWS is based in Sydney but has a national reach having offices all around Australia. We are able to cater to both statewide and national projects hence making CWS an ideal choice for customers.</p>
			
			<p style="text-align:;">We would greatly appreciate any opportunity to provide pricing on any upcoming project – all specifications and quotations are free of charge. We’d bebe happy to meet at your office or on-site as required to provide more information about ourselves and our vision.</p>
			
			<p style="text-align:;">Please feel free to contact us anytime should you wish to discuss anything in more detail, or if you’d like any further information.</p>
			
			<br/><br/>
			<p>Best Regards,</p>
			<p>THE CWS TEAM - Protecting your Future</p>
			<p>P: (02) 9099 1295</p>
			<p>Web: www.cwsaus.com.au</p>
			<p>info@cwsaus.com.au</p>
			
			</div>	
		   <br>  <br>
		   <img style="width:100%;" src="http://cwsaus.com.au/cws/Email_letter_13.png">         
	  </div>  
	</div>';
	
	$fileName = 'CWS Company Profile.pdf';
	$filePath = dirname(__FILE__).'/'.$fileName;
	
	try{
		#$subject = 'CWS :- Waterproofing and Epoxy Flooring';
		$from = new SendGrid\Email("Construction Waterproofing Solutions", $senderemail);
		$to = new SendGrid\Email("Construction Waterproofing Solutions", $insertbuildersname);
		$content = new SendGrid\Content("text/html", $message);
		
		$file_encoded = base64_encode(file_get_contents($filePath));
		$attachment = new SendGrid\Attachment();
        $attachment->setContent($file_encoded);
        $attachment->setContentId("123");
        $attachment->setType("pdf");
        $attachment->setDisposition("attachment");
        $attachment->setFilename("CWS Company Profile.pdf");	
			
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->addAttachment($attachment);
		
		$apiKey = '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';
		$sg = new \SendGrid($apiKey);
		
		$response = $sg->client->mail()->send()->post($mail); 
	}catch(Exception $e){
		
	}
	}
	}
	$success = 'sent successfully';
	}
?>
<?php if(!empty($success)){ ?><p class="alert alert-success"><?php echo $success ?></p><?php  } ?>
<form action="" method="post" style="paadding:10px;margin:10px;">
	<div style="border:1px solid #000; width:80%; margin:20px 0px; padding:10px;">
		<p>Insert Indivdual name:  <input type="text" name="inserIndivdualtname[]" value="" required></p>
		<p>Insert Company Name:  <input type="text" name="insertcompanyname[]" value="" required></p>
		<p>Project Name:  <input type="text" name="projectname[]" value="" required></p>
		<p>Insert builders email:  <input type="text" name="insertbuildersname[]" value="" required></p>
		<p>Date:  <input type="date" name="date[]" value="" required></p>
		<p>Insert Name:  <input type="text" name="insertname[]" value="" required></p>
		<p>Sender Email:  <input type="text" name="senderemail[]" value="info@cwsaus.com.au" required></p>
		<p>Subject:  <input type="text" name="subject[]" value="CWS :- Waterproofing and Epoxy Flooring" required></p>
		
	</div>
	<div id="newdiv"></div>
	
	
	<p><input type="submit" name="submit" value="Send Email" class="btn btn-primary"> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#null" onclick="addmore()">Add More</a></p>
	
	
</form>

<script>
 	function addmore(){
		
		var data = '<div style="border:1px solid #000; width:80%; margin:10px 0px;  padding:10px;"><p>Insert Indivdual name:  <input type="text" name="inserIndivdualtname[]" value="" required></p>		<p>Insert Company Name:  <input type="text" name="insertcompanyname[]" value="" required></p>		<p>Project Name:  <input type="text" name="projectname[]" value="" required></p>	<p>Insert builders email:  <input type="text" name="insertbuildersname[]" value="" required></p>		<p>Date:  <input type="date" name="date[]" value="" required></p>	<p>Insert Name:  <input type="text" name="insertname[]" value="" required></p><p>Send Email:  <input type="text" name="senderemail[]" value="info@cwsaus.com.au" required></p><p>Subject:  <input type="text" name="subject[]" value="CWS :- Waterproofing and Epoxy Flooring" required></p></div>';
		
		$('#newdiv').append(data);
	} 	
</script>

</body>
</html>