<div class="page-content">
	<div class="page-header">
	<h1>
	Natspec Presentation
	<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
		Natspec Presentation
	</small>
	</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			
			<form action="" method="post" >
				<div class="box">
					<div class="box-header">				  
					</div>					
					<div class="box-body">
						<?php if($user['NappUser']['is_natspec_presentation'] == 1){ ?>
							<iframe src="<?php echo SITEURL.'wp-content/uploads/Durotech Workshop  Presentation - final.pdf'?>" style="width:100%; height:530px; border:none;"></iframe>
						<?php }else{ ?>
							<h3> Sorry, you don't have access to this folder. You can request the admin to give you access. <a href="<?php echo SITEURL.'users/access/1'; ?>">Click here</a></h3>
						<?php }?>
					</div>
				</div>
			</form>
		</div>
		
	</div>
</div>	
