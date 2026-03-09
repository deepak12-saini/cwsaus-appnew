	<script src="<?php echo SITEURL;?>ckeditor/ckeditor.js"></script>
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
		<h1>Email Template<small><i class="ace-icon fa fa-angle-double-right"></i> Add New Email Template</small>
		</h1>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('EmailTemplate',array('class'=>'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Name'))?>
				</div>
			</div>											
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Template Content : </label>
				<div class="col-sm-7">
					
					<?php echo $this->Form->input('description',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'description','placeholder'=>'Template Content'))?>
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
<script type="text/javascript">
			jQuery(function(){ 	
				    
				    CKEDITOR.replace( 'description' );
					
					$("#name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter name"
                }); 
			});
			</script>
