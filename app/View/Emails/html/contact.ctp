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

<body bgcolor="#cccccc" rightmargin="0" leftmargin="0" topmargin="0" bottommargin="0" marginwidth="0" marginheight="0" offset="0" style="margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; border:0px;">



<!-- begin wrapper table -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#cccccc" style="margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; border:0px; ">
<tr><td valign="top" align="center" style="padding-top:20px; padding-right:0px; padding-bottom:20px; padding-left:0px;">


<table width="600" cellpadding="0" cellspacing="0" style="font-family:Arial; font-size:14px; color:#506194; padding-top:0px; padding-right:20px; padding-bottom:0px; padding-left:20px;">




<tr><td align="center" bgcolor="#f8fad7" style="padding:20px; text-align:center; font-family:Arial; font-size:27px; color:#fff;">
<img src="<?php echo SITEURL ?>assets/img/logo.png" alt="<?php echo SITENAME?>" style="padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; margin-top:0px; margin-right:0px; margin-bottom:0px; margin-left:0px; border:0px;">
</td></tr>



<tr><td align="left" bgcolor="#FFFFFF" style="padding-top:0px; padding-right:0px; padding-bottom:0px; padding-left:0px; text-align:left; font-family:Arial; font-size:12px; color:#333333; line-height:22px;">


<table align="center" width="560" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
  <tr>   
    <td>
    <p style="padding-top:0; padding-right:35px; padding-left:35px; text-align:left; font-family:Arial; font-size:18px; color:#333333;">Hello <?php echo $receiver_name ?>,</p>
     <p style="padding-right: 35px; padding-left: 35px; text-align: left; font-family: Arial; color: rgb(51, 51, 51); padding-top: 8px; font-size: 18px;"><?php echo $top_content?> </p>
     
    </td></tr>
	
		<tr>	
			<td>
			<table style="float: left; margin: 0px; padding: 0px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0px solid #ccc" bgcolor="#fff">
			<tr>
			<td style="padding:0 20px;  float: left;font-size:17px;"><strong style="padding: 0px; font-size:17px; width:100%; float:left;"></strong>
			<p style="padding: 0px; font-size:14px; width:100%; margin: 4px 0 0;float:left;"><?php echo $message; ?></p>
			</td>
			</tr>
			
			</table>
			<td>
		</tr>	
			


<table cellspacing="0" cellpadding="0" border="0px solid #ccc" width="70%"  style="margin:0; float:left; margin:0 0px;">
	<tr>
	<td style="padding:0px 40px 26px 40px;font-size:18px">Regards,<br> <a href="<?php echo SITEURL ?>" style="color: #333333; font-size: 17px;  text-decoration: none;  text-transform: uppercase;"><?php echo SITENAME?></a></td></tr>

	</tr>
	</table></td></tr>


</table>
<!-- end main table -->

</td></tr></table>
<!-- end wrapper table -->



</body>
</html>
