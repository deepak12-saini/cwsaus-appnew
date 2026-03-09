<?php
require '../cws/sendgrid/vendor/autoload.php';

$name = ucfirst($_REQUEST['name']);
$sendto = $_REQUEST['email'];
$senderemail = $_REQUEST['senderemail'];
$subject = $_REQUEST['subject'];
$lastinset = $_REQUEST['lastinset'];

$message = '<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body bgcolor="#fff">
<table class="head-wrap" style="width: 100%;"  border="0" cellspacing="0" cellpadding="0" style="background: #e1f4fd;">
	<tr>
		<td></td>
		<td class="header container" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important;">
				<div class="content" style="padding:15px;	max-width:600px;	margin:0 auto;	display:block; " >
				<table  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><a href="https://cwsaus.com.au"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_01(1).png" style="max-width: 100% !important;" /></a></td>
						<td align="right"></td>
					</tr>
					
				</table >	
				
				<table cellpadding="0" cellspacing="0" style="background: #e1f4fd;margin:0;  padding:15px 25px 25px; width: 100%; ;">
				<tr>
					<td align="left" style="padding:0;"  >
						
							<p style=" text-align:left; font-weight:600; font-size:13px;  line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							Dear Valued Client '.$name.',
							</p>
							<p style="text-align:left; font-weight:600; font-size:13px;line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							Thank you for expressing interest in receiving more information about Construction waterproofing solutions Services, Products both Epoxy flooring & Waterproofing Systems.
							</p>
							<p style=" text-align:left; font-weight:600; font-size:13px;line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							I am attaching a Construction Waterproofing Solutions company profile for your perusal and further details can be found via the website <a href="http://cwsaus.com.au">www.cwsaus.com.au</a>
							</p>
							<p style=" text-align:left; font-weight:600; font-size:13px;line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							I have also attached a link below to our company Instagram page where we are continually updating and posting our project gallery.
							</p>
							<p style=" text-align:left; font-weight:600; font-size:13px;line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							<a href="https://www.instagram.com/cws_aus">https://www.instagram.com/cws_aus</a>
							</p>
							
							<p style=" text-align:left; font-weight:600; font-size:13px;line-height:20px; margin:0; letter-spacing: 1px;padding:10px 0;">
							Kindly have a look & let us know if we can be of assistance. We will endeavor to contact you soon to facilitate a meeting with one of our Technical Representative at a mutually convenient time to discuss projects and pricing.
							</p>
						
					</td>
				</tr>
				
				</table>
				<table border="0" cellspacing="0" cellpadding="0"  style="background: #e1f4fd;margin:0;">								
					
					<tr>
						<td><a href="https://www.instagram.com/cws_aus"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_03.png" style="max-width: 100% !important;" /></a></td>
						<td align="right"></td>
					</tr>
					<tr>
						<td><a href="mailto:info@cwsaus.com.au"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_04.png" style="max-width: 100% !important;" /></a></td>
						<td align="right"></td>
					</tr>
					<tr>
						<td><a href="tel:+61290991295"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_05.png" style="max-width: 100% !important;" /></a></td>
						<td align="right"></td>
					</tr>
					<tr>
						<td><a href="mailto:info@cwsaus.com.au"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_06.png" style="max-width: 100% !important;" /></a><a href="mailto:info@cwsaus.com.au"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_07.png" style="max-width: 100% !important;" /></a></td>
						<td></td>
					</tr> 
					<tr>
						<td><a href="http://cwsaus.com.au"><img src="https://cwsaus.com.au/welcomemailer/CWS-EOI-Thankyou-Emailer_08.png" style="max-width: 100% !important;" /></a></td>
						<td align="right">
						<img src="https://cwsaus.com.au/customcws/mailers/updatewelcome/'.$lastinset.'" style="display:none;" />
						</td>
					</tr>
				</table>				
			</div>				
		</td>
		<td></td>
	</tr>
</table>';


try{
		##$subject = 'CWS :- Welcome To Construction Waterproofing Solutions';
		$from = new SendGrid\Email("Welcome To Construction Waterproofing Solutions", $senderemail);
		$to = new SendGrid\Email("Construction Waterproofing Solutions", $sendto);
		$content = new SendGrid\Content("text/html", $message);		
		$mail = new SendGrid\Mail($from, $subject, $to, $content);	
		
		$apiKey = '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';
		$sg = new \SendGrid($apiKey);
		
		$response = $sg->client->mail()->send()->post($mail); 
		
	}catch(Exception $e){
		
	}
	echo 'success';
