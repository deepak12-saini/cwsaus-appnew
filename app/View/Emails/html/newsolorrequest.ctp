<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CWS</title>
<!-- Favicon -->
<link rel="shortcut icon" type="image/icon" href="images/favicon.ico"/>

<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,200i,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">

<style>

@media(max-width:820px ) {

.mobresponsive { width:97%!important;padding: 15px !important; }


}
</style>

</head>
<body style="font-family:Poppins,sans-serif; font-weight: 500;  font-size: 16px; color:#231f20; margin:0; padding:0;">

<!-- Start content -->
<section id="formcontent">
  <table class="mobresponsive" style="width:800px; margin:30px auto; background:#f8f8f8; padding: 30px;">
	  <tr>
		<td>
		
		<table style="text-align:center;background:#fff;float:left;margin: 0 0 25px;padding: 0 0 20px; width: 100%; padding: 10px 0;">
			<tr>
				<td align="center"><a href="#"><img src="<?php echo SITEURL; ?>front_theme/images/logo.png" alt="<?php echo SITENAME; ?>"/></a></td>
			</tr>
		</table>
		
		<table style="text-align: center; float: left; width: 100%; border-bottom: 1px solid rgb(240, 240, 240); padding: 0px 0px 8px; margin: 15px 0px 20px;">
			<tr>
				<td align="left"><h2 style="color:#231f20;float: left;font-size:16px; line-height: 20px;font-weight:500;letter-spacing: 1px;margin: 0;padding: 0 0 9px; width: 100%;">Hi Admin,</h2></td>
			</tr>
		</table>
		  
		<table style="text-align: center; float: left; width: 100%; border-bottom: 1px solid rgb(240, 240, 240); padding:0 20px 8px; margin: 15px 0px 20px;">
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;"><?php echo ucfirst($name); ?> has made request for CWS. Please follow up and give reponse quickly.</td>
			</tr>
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;">Request id: <?php echo $requestid; ?></td>
			</tr>
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;">Name: <?php echo $name; ?></td>
			</tr>
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;">Email: <?php echo $email; ?></td>
			</tr>
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;">Phone Number: <?php echo $phone; ?></td>
			</tr>
			<tr>
				<td style="color:#231f20;float: left;font-size:15px; line-height: 24px;font-weight:500;margin: 0;padding: 0 0 9px; width: 100%;">Message: <?php echo $message; ?></td>
			</tr>
		</table>
			
			
		<table style="text-align: center; float: left; width: 100%;padding: 0px 0px 0; margin: 15px 0px 0;">
			<tr>
				<td align="left"><h2 style="color:#231f20;float: left;font-size:16px; line-height: 20px;font-weight:600;letter-spacing: 1px;margin: 0;padding: 0 0 9px; width: 100%;">Thanks, from the team at <?php echo SITENAME; ?></h2></td>
			</tr>
			<tr>
				<td align="left"><a href="#"><img src="<?php echo SITEURL; ?>front_theme/images/logo.png" alt="<?php echo SITENAME; ?>"/></a></td>
			</tr>
		</table>	
			
		
		</td>
	  </tr>
  </table>
</section>
<!-- End content --> 
</body>
</html>