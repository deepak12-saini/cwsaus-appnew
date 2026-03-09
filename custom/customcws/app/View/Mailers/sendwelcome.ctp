	<style>
		.form-group {
			margin-bottom: 4px;
		}
	</style>
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
		<h1> Email  <small><i class="ace-icon fa fa-angle-double-right"></i>Send Welcome Emailer</small>
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('WelcomeMailer',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name:</label>
				<div class="col-sm-9">
					<input type="text" name="name" value="" required class = "col-xs-10 col-sm-5">
				</div>
			</div>			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email:</label>
				<div class="col-sm-9">
					<input type="text" name="email" value="" required class = "col-xs-10 col-sm-5" >
				</div>
			</div>						
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sender Email:</label>
				<div class="col-sm-9">
					<input type="text" name="senderemail" value="info@cwsaus.com.au" required class = "col-xs-10 col-sm-5">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Subject:</label>
				<div class="col-sm-9">
					<input type="text" name="subject" value="Welcome To Construction Waterproofing Solutions" required class = "col-xs-10 col-sm-5">
				</div>
			</div>
		
			<div id="newdiv"></div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-mini  btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>	
	</div>	
	
<script type="text/javascript">
			jQuery(function(){ //short for $(document).ready(function(){

				$("#name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter name"
                }); $("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter email"
                });  $("#senderemail").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter sender email"
                }); 
			});

 	
</script>