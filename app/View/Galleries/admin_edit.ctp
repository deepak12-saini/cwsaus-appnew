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
		<li class="active">Edit Gallery</li>
		
	</ul><!-- /.breadcrumb -->

</div>	
	<div class="page-content">
		<div class="page-header">
			<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
			<h1>Gallery<small><i class="ace-icon fa fa-angle-double-right"></i> Edit</small>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('Gallery',array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<input type="hidden" name="data[Gallery][image]" value="<?php echo $Gallery['Gallery']['image'];?>">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title:  </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('title',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'title','placeholder'=>'Gallery Title'))?>
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Image : </label>
				<div class="col-sm-9">
				
					<?php if($Gallery['Gallery']['image']!=''){?>
					<br>
					<img src="<?php echo SITEURL.'gallery/'.$Gallery['Gallery']['image'];?>" width="100">
				
					<br>
					<a href="<?php echo SITEURL.'admin/galleries/delete_image/'.$Gallery['Gallery']['id'];?>">Delete</a>
					<?php }else{ ?>
						<input type="file" name="data[Gallery][image]" id="images" cols="50">
					<?php }?>
				</div>				
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
				<div class="col-sm-9">
					
					<?php echo $this->Form->input('description', array('type' => 'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5 ckeditor','id'=>'description','placeholder'=>'description','value'=>$Gallery['Gallery']['description']));?>
				</div>
			</div>
				<div class="form-group">
					<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
						<div class="col-sm-9">
						<?php if($Gallery['Gallery']['status'] == 1) { $active='checked';$inactive='';}else{  $active='';$inactive='checked';}?>
						
						<div class="radio"><label>
						<input type="radio"  value="1" <?php echo $active; ?>  class="ace" id="ServiceCategoryActive1" name="data[Gallery][status]"><span class="lbl"> Active</span>
						</label></div>
						
						<div class="radio"><label>
							<input type="radio" value="0" class="ace" <?php echo $inactive; ?> id="ServiceCategoryActive0" name="data[Gallery][status]"><span class="lbl"> Inactive</span>
						</label></div>
						
						
					</div>
			</div>				
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-9">
				<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
				<?php echo $this->Html->link('Cancel','javascript:window.history.back();',array('class' => 'btn btn-danger'));?>

			</div><BR>
		</div>
		<?php echo $this->Form->end(); ?>
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
			
			CKEDITOR.replace('description', {
    filebrowserBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor',
    filebrowserImageBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=image',
	filebrowserFlashBrowseUrl : '<?php echo SITEURL;?>js/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
	
	//filebrowserUploadUrl : 'ckeditor/pdw_file_browser/',
	//filebrowserImageUploadUrl : 'ckeditor/pdw_file_browser/',
	
    filebrowserWindowWidth  : 800,
    filebrowserWindowHeight : 500
});
			</script>
