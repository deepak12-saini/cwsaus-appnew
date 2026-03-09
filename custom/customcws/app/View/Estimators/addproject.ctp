	<script src="<?php echo SITEURL ?>ckeditor/ckeditor.js"></script>
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
		<h1>Project Estimator <small><i class="ace-icon fa fa-angle-double-right"></i> Add New</small>
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Estimator',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Project Name: <br> </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('project_name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'project_name','placeholder'=>'Project Name'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company:</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('company',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'company','placeholder'=>'Company'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Name:</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('client_name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'client_name','placeholder'=>'Client Name'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> upload file:</label>
				<div class="col-sm-9">
					<input type="file" name="file" id="file"  class="col-xs-10 col-sm-5">
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Project Description: </label>
				<div class="col-sm-9">
					<textarea name="data[Estimator][project_description]" id="project_description" class="ckeditor col-xs-10 col-sm-5" placeholder="Project Description" ></textarea>
				
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Result: </label>
				<div class="col-sm-9">
					<textarea name="data[Estimator][estimate]" id="estimate" class="ckeditor col-xs-10 col-sm-5" placeholder="Result" ></textarea>
				
				</div>
			</div>
					
			<!--div class="form-group">
				<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status: </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" checked="checked" value="1"  class="ace" id="CategoryActive1" name="data[Estimator][status]"><span class="lbl"> Active</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  class="ace" id="CategoryActive0" name="data[Estimator][status]"><span class="lbl"> Inactive</span>
				</label></div>				
				</div>
			</div-->				
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-mini btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					<?php echo $this->Html->link('Cancel','javascript:window.history.back();',array('class' => 'btn  btn-mini  btn-danger'));?>

				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>	
	</div>	
<script type="text/javascript">
jQuery(function(){ //short for $(document).ready(function(){

	$("#category_name").validate({
		 expression: "if (VAL) return true; else return false;",
		message: "Please enter category name"
	}); $("#imagse").validate({
		 expression: "if (VAL) return true; else return false;",
		message: "Please select image"
	}); 
});
</script>
