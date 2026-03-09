<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

	$device = '';	
	if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
		$device = "ipad";
	} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
		$device = "iphone";
	} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
		$device = "blackberry";
	} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
		$device = "android";
	}
	
	if($device == "iphone"){		
	?>
	
	<script>
		$(document).ready(function(){
		setTimeout(function(){								
			 window.location.href = $('#iphonelink').attr('href');
		},1000);	
		});	
	</script>
	<a href="https://itunes.apple.com/us/app/durotech/id1262728802?ls=1&mt=8" id="iphonelink">&nbsp;</a>
	<?php
	   
	}else if($device == "android"){
	      header('location:https://play.google.com/store/apps/details?id=com.xoro.durotech&hl=en');		
	}else{
		header('location:http://www.durotechindustries.com.au/');	
	}  
?>
