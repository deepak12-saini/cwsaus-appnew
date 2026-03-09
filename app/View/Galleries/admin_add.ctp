<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
		<li class=""><a href="<?php echo SITEURL; ?>admin/galleries">Gallery</a></li>
		<li class="active">Add Gallery</li>
		
	</ul><!-- /.breadcrumb -->

</div>	
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
		<h1>Add Gallery<small><i class="ace-icon fa fa-angle-double-right"></i> 
</small>
		</h1>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Gallery',array('enctype'=>'multipart/form-data','class'=>'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('title',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'title','placeholder'=>'Gallery Title'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Image: </label>
				<div class="col-sm-9">
						<input type="file" name="data[Gallery][image]" id="image" cols="50">
					
				</div>				
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
				<div class="col-sm-9">
					
					<?php echo $this->Form->input('description', array('type' => 'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5 ckeditor','id'=>'description','placeholder'=>'description','value'=>''));?>
				</div>
			</div>
			<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
				<div class="col-sm-9">
				
				
				<div class="radio"><label>
				<input type="radio" checked="checked" value="1"  class="ace" id="CategoryActive1" name="data[Gallery][status]"><span class="lbl"> Active</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  class="ace" id="CategoryActive0" name="data[Gallery][status]"><span class="lbl"> Inactive</span>
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
<script type="text/javascript" src="<?php echo SITEURL;?>ckeditor/ckeditor.js"></script>		
<script type="text/javascript">
			jQuery(function(){ //short for $(document).ready(function(){

				$("#title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter category name"
                }); 
				$("#image").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please upload image"
                }); 
			});
			
			KEDITOR.replace('description', {
    filebrowserBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor',
    filebrowserImageBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=image',
	filebrowserFlashBrowseUrl : '<?php echo SITEURL;?>js/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
	
	//filebrowserUploadUrl : 'ckeditor/pdw_file_browser/',
	//filebrowserImageUploadUrl : 'ckeditor/pdw_file_browser/',
	
    filebrowserWindowWidth  : 800,
    filebrowserWindowHeight : 500
});
			</script>
