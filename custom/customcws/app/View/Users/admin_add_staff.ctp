<div class="page-content">
	<div class="page-header">
	<h1>
	Staff List
	<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
		Add Staff
	</small>
	</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">StaffId: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Staff.staff_id',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'staff_id','placeholder'=>'Enter staff id'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Staff.name',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Enter Name'))?>
					</div>
				</div>
			
				<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email: </label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('Staff.email',array('type'=>'email','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'email','placeholder'=>'Email'))?>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone Number: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Staff.phone',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'phone','placeholder'=>'Phone Number'))?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Designation: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Staff.designation',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'designation','placeholder'=>'Designation'))?>
					</div>
				</div>
				
				<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					<?php echo $this->Html->link('Cancel','javascript:window.history.back();',array('class' => 'btn btn-danger'));?>

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
                });$("#username").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter username"
                });$("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter email"
                });$("#phone").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter phone"
                }); 
			});
			</script>