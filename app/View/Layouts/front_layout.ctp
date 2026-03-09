<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<!--meta name="format-detection" content="telephone=yes"-->
    <meta name="author" content="">
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/icon" href="<?php echo SITEURL ;?>front_theme/images/logo.png"/>
		<!-- Font Awesome -->
		<link href="<?php echo SITEURL ;?>front_theme/css/font-awesome.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="<?php echo SITEURL ;?>front_theme/css/bootstrap.css" rel="stylesheet">
		<!-- Slick slider -->
		<link rel="stylesheet" type="text/css" href="<?php echo SITEURL ;?>front_theme/css/slick.css"/>
		<!-- Animate css -->
		<link rel="stylesheet" type="text/css" href="<?php echo SITEURL ;?>front_theme/css/animate.css"/>
		<!-- Main Style -->
		<link href="<?php echo SITEURL ;?>front_theme/style.css" rel="stylesheet">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,200i,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery library --> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
		<!-- <script src="<?php echo SITEURL ;?>theme/js/jquery.js"></script> -->
		<script src="<?php echo SITEURL ;?>theme/js/jquery.validate.js"></script>
		<script src="<?php echo SITEURL ;?>theme/js/jquery-ui.js"></script>

		
		<!-- Add fancyBox main JS and CSS files -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<style>	
.ValidationErrors{
    color: #d00;
    display: inline-block;
    font-size: 12px;
    font-style: italic;
    padding-left: 10px;
}
</style>
</head>
<body>
<!-- SCROLL TOP BUTTON --> 
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a> 
<!-- END SCROLL TOP BUTTON --> 	
		<?php echo $this->element('front_header'); ?>
	
		

		<?php echo $this->fetch('content'); ?>

		<?php echo $this->element('front_footer'); ?>

	
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<!-- Bootstrap --> 
	<script src="<?php echo SITEURL ;?>front_theme/js/bootstrap.js"></script> 
	<script type="text/javascript" src="<?php echo SITEURL ;?>front_theme/js/slick.js"></script> 
	<script src="<?php echo SITEURL ;?>front_theme/js/waypoints.js"></script> 
	<script src="<?php echo SITEURL ;?>front_theme/js/jquery.counterup.js"></script> 
	<script type="text/javascript" src="<?php echo SITEURL ;?>front_theme/js/wow.js"></script> 
	<script type="text/javascript" src="<?php echo SITEURL ;?>front_theme/js/bootstrap-progressbar.js"></script> 
	<script type="text/javascript" src="<?php echo SITEURL ;?>front_theme/js/custom.js"></script>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
