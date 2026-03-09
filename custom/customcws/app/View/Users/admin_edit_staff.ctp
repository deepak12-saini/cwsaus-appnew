<div class="page-content">
	<div class="page-header">
	<h1>Staff List	<small>	<i class="ace-icon fa fa-angle-double-right"></i>Edit Staff	</small>	</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">StaffId: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('NappUser.emp_id',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'emp_id','placeholder'=>'Enter staff id'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('NappUser.name',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Enter First Name'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('NappUser.lname',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Enter Last Name'))?>
					</div>
				</div>
			
			
				<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email: </label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('NappUser.email',array('type'=>'email','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'email','placeholder'=>'Email'))?>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile Number: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('NappUser.mobile_number',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'mobile_number','placeholder'=>'Mobile Number'))?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Designation: </label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('NappUser.designation',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'designation','placeholder'=>'Designation'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Is Appove: </label>
					<div class="col-sm-9">
						
						<input type="radio" name="data[NappUser][is_approved]" value="1" <?php if($staffArr['NappUser']['is_approved'] == 1){ ?> checked <?php  }?>> Approve
						<input type="radio" name="data[NappUser][is_approved]" value="2" <?php if($staffArr['NappUser']['is_approved'] == 2){ ?> checked <?php  }?>> Disapprove
					</div>
				</div>
				<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<?php echo $this->Form->submit('Update',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
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
                });$("#emp_id").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter staff id"
                });$("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter email"
                });
			});
			</script>