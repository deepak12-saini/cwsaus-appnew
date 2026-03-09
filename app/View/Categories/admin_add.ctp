<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
		<li class=""><a href="<?php echo SITEURL; ?>admin/categories">Category</a></li>
		<li class="active">Add Category</li>
		
	</ul><!-- /.breadcrumb -->

</div>	
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Vack</a></div>
		<h1>Add Category<small><i class="ace-icon fa fa-angle-double-right"></i> 
</small>
		</h1>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Category',array('class'=>'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'category_name','placeholder'=>'Category Name'))?>
				</div>
			</div>	
			<!-- <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> description : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('description',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'description','placeholder'=>'description'))?>
				</div>
			</div>		 -->		
			<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
				<div class="col-sm-9">
				
				
				<div class="radio"><label>
				<input type="radio" checked="checked" value="1"  class="ace" id="CategoryActive1" name="data[Category][status]"><span class="lbl"> Active</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  class="ace" id="CategoryActive0" name="data[Category][status]"><span class="lbl"> Inactive</span>
				</label></div>				
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
			jQuery(function(){ //short for $(document).ready(function(){

				$("#category_name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter category name"
                }); 
			});
			</script>
