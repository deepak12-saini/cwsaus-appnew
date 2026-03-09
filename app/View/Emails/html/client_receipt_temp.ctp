<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mail template</title>
<style type="text/css">

h2,h3,h4,p { color:#000000; }
table { font-family:Arial; font-size:14px; }

</style>
</head>


<body bgcolor="#fff" rightmargin="0" leftmargin="0" topmargin="0" bottommargin="0" marginwidth="0" marginheight="0" offset="0" style="margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; border:0px;">



<!-- begin wrapper table -->
<table width="600" border="0" cellspacing="0" cellpadding="0" style="background: #f8fad7; font-size:14px; color:#506194;margin:30px auto;  border: 1px solid #e2e2e2; padding: 0 12px 13px;">
<tr><td valign="top" align="center" style="background: #f8fad7; padding-top:20px; padding-right:0px; padding-bottom:0; padding-left:0px;">


<table cellpadding="0" cellspacing="0" style="background: #f8fad7;font-family:Arial; font-size:14px; color:#506194; padding:0px;">




<tr><td align="center" bgcolor="#fff" style="background: #f8fad7; padding:0; text-align:center; font-family:Arial; font-size:27px; color:#fff;">
<img src="<?php echo SITEURL ?>assets/img/logo_lnd.png"  style="padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; border:0px;">
</td></tr>



<tr><td align="left" bgcolor="#FFFFFF" style="background: #f8fad7; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; text-align:left; font-family:Arial; font-size:12px; color:#333333; line-height:22px;">


<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
  <tr>   
    <td style="background: #f8fad7;">
    <p style="background: #f8fad7; padding-top:15px; border-top: 1px solid #e2e2e2; padding-right:0; padding-left:0; text-align:left; font-family:Arial; font-size:18px; color:#333333;">Hello <?php echo $receiver_name; ?> ,</p>
     <p style="background: #f8fad7; padding-right: 35px; padding-left: 35px; text-align: left; font-family: Arial; color: rgb(51, 51, 51); padding-top: 8px; font-size: 18px;"> </p>
     
    </td></tr>
	
		<tr>	
			<td>
			<table width="570" cellpadding="0" cellspacing="0" style="">
			<tr>
				<td align="center" style="background: #f8fad7;">
				
<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #f8fad7; border-bottom: 1px solid #e2e2e2; float: left; padding: 7px 0; width: 100%;">
						<tr>
							<td style="background: #f8fad7; float: left; color: #333; font-size: 21px;  font-weight: 300; margin:0; font-family:arial;"><h3 style="float: left; color: #333; font-size: 21px;  font-weight: 300;  margin: 4px 0 0; width: 310px; font-family:arial;"><?php echo $top_content['ClientPlan']['client_fname']; ?>'s Receipt</h3></td>
							<td style=" background: #f8fad7;border-left: 1px solid #e2e2e2;   display: inline;   float: right;   padding: 0 0 0 20px; font-family:arial;"><p style="font-size: 13px; font-family:arial; font-weight: 400; color: #333; margin: 0;">Order Id: <span style="color: #d45424;">#<?php echo $top_content['ClientPlan']['unique_id'];?></span></p>
							<p>Date: <?php echo date('M d Y H:i a',strtotime($top_content['ClientPlan']['paid_date']));?></p>
						</tr>
					</table>
					
					<!-- end title -->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="float: left; margin: 0; width: 100%;">
						<tr>
							<td style="background: #2caee4; color: #fff; float: left; font-size:17px; font-weight:normal; margin:15px 0 0;  padding: 4px 0; text-align: center;  width: 100%; font-family:arial;"><h3 style="text-align: center;  width: 100%; font-family:arial; color: #fff; float: left; font-size:17px; font-weight:normal; margin:0;">Plan</h3></td>
						</tr>
					</table>
					
					<!-- end shop title-->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #f5f5f5; float: left; margin: 0 0 20px; padding: 15px 15px 5px;
			width: 100%;">
						<tr>
							<td style=""><p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Plan Name: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['employer_plan_name']; ?></span></p>
								
						</tr>
					</table>
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="float: left; margin: 0; width: 100%;">
						<tr>
							<td style="background: #2caee4; color: #fff; float: left; font-size:17px; font-weight:normal; margin:15px 0 0;  padding: 4px 0; text-align: center;  width: 100%; font-family:arial;"><h3 style="text-align: center;  width: 100%; font-family:arial; color: #fff; float: left; font-size:17px; font-weight:normal; margin:0;">Client Detail</h3></td>
						</tr>
					</table>
					
					<!-- end shop title-->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #f5f5f5; float: left; margin: 0 0 20px; padding: 15px 15px 5px;
			width: 100%;">
						<tr>
							<td style=""><p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">First name: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['client_fname']; ?></span></p>
								<p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Last name: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['client_lname']; ?></span></p>
								<p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Email: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['client_email']; ?></span></p>
								<p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Phone: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['client_phone']; ?></span></p></td>
						</tr>
					</table>
					

						
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="float: left; margin: 0; width: 100%;">
						<tr>
							<td style="background: #2caee4; color: #fff; float: left; font-size:17px; font-weight:normal; margin:15px 0 0;  padding: 4px 0; text-align: center;  width: 100%; font-family:arial;"><h3 style="text-align: center;  width: 100%; font-family:arial; color: #fff; float: left; font-size:17px; font-weight:normal; margin:0;">Transactions Detail</h3></td>
						</tr>
					</table>
					
					<!-- end shop title-->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #f5f5f5; float: left; margin: 0 0 20px; padding: 15px 15px 5px;
			width: 100%;">
						<tr>
							<td style=""><p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Transactions: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['transaction_id']; ?></span></p>
								<?php if($top_content['ClientPlan']['type']!=1){ ?>
								<!--p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Payer Id: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['payer_id']; ?></span></p-->
								<p style="font-size: 14px;color: #333;  font-weight: 300; margin: 0 0 14px; font-family:arial;">Profile Id: <span style="color: #404040;
			font-weight: bold;  margin: 0 0 0 6px;"><?php echo $top_content['ClientPlan']['profileid']; ?></span></p>
								<?php } ?>	
								
						</tr>
					</table>
					<!-- end detail -->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #fff; float: left; margin:0; padding:0 10px;width: 100%; background: #f8fad7;">
						<tr>
							<?php if($top_content['ClientPlan']['type']==0){ ?>
							<td style=""><h6 style="color: #505050; float: left; font-size: 20px;  font-weight: 600; margin:0 0 8px; padding:0; text-align:right; width:100%;"> <span style=" display: inline-block; font-family: arial; font-size: 16px; font-weight: lighter;">Installation Fee:</span> $<?php echo $top_content['ClientPlan']['installation_fee']; ?></h6>
								<h6 style="color: #505050; float: left; font-size: 20px;  font-weight: 600; margin:0 0 8px; padding:0; text-align:right; width:100%;"> <span style=" display: inline-block; font-family: arial; font-size: 16px; font-weight: lighter;">Maintenance Fee:</span> $<?php echo $top_content['ClientPlan']['rec_fee']; ?></h6></td>
							<?php } ?>	
							<?php if($top_content['ClientPlan']['type']==1){ ?>
							<td style=""><h6 style="color: #505050; float: left; font-size: 20px;  font-weight: 600; margin:0 0 8px; padding:0; text-align:right; width:100%;"> <span style=" display: inline-block; font-family: arial; font-size: 16px; font-weight: lighter;">Filing Fee:</span> $<?php echo $top_content['ClientPlan']['filing_fee']; ?></h6>
								</td>
							<?php } ?>	
						</tr>
					</table>
					
					<!-- end fees -->
					
					<table align="center" border="0" cellspacing="0" cellpadding="0" style="background: #f5f5f5; float: left; padding: 10px; width: 100%;">
						<tr>
							<?php if($top_content['ClientPlan']['type']==0){ ?>
							<td style=""><h6 style="color:#d45424;float: left;font-size: 20px; font-style: italic; font-weight: 600; margin: 0; padding: 0; text-align: right;
			width: 100%;"><span style="color: #505050; display: inline-block; font-size: 18px; font-weight: 300;">Total amount:</span>$<?php echo $top_content['ClientPlan']['installation_fee'] + $top_content['ClientPlan']['rec_fee']; ?></h6></td>
			<?php } ?>	
			<?php if($top_content['ClientPlan']['type']==1){ ?>
				<td style=""><h6 style="color:#d45424;float: left;font-size: 20px; font-style: italic; font-weight: 600; margin: 0; padding: 0; text-align: right;
			width: 100%;"><span style="color: #505050; display: inline-block; font-size: 18px; font-weight: 300;">Total amount:</span>$<?php echo $top_content['ClientPlan']['filing_fee'] ; ?></h6></td>
			<?php } ?>	
						</tr>
					</table>
					
					<!-- end fees --></td>
			</tr>
		</table>
			<td style="background-color:#f5f5f5;">
		</tr>	
<table cellspacing="0" cellpadding="0" border="0px solid #ccc" width="70%"  style="margin:0; float:left; margin:0 0px;">
	<tr>
	<td style="padding:13px 10px 0;font-size:18px">Regards,<br> <a href="<?php echo SITEURL ?>" style="color: #333333; font-size: 17px;  text-decoration: none;  text-transform: uppercase;"><?php echo SITENAME; ?></a></td></tr>

	</tr>
	</table></td></tr>


</table>
<!-- end main table -->

</td></tr></table>
<!-- end wrapper table -->



</body>
</html>
 