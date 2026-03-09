<script type="text/javascript" src="<?php echo SITEURL;?>ckeditor/ckeditor.js"></script>
	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/menus">Menu</a></li>
			<li class="active">Edit Menu</li>
	</ul><!-- /.breadcrumb -->


</div>
<div class="page-content">
	<div class="page-header">
		<h1>Edit Menu <small><i class="ace-icon fa fa-angle-double-right"></i>Edit Menu </small></h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('MenuPage',array('class'=>'form-horizontal')); ?>
			<input type="hidden" name="data[MenuPage][id]" value="<?php echo $menu['MenuPage']['id'];?>" >
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Display Name  </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('display_name',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'display_name','placeholder'=>'Display Name','value'=>$menu['MenuPage']['display_name']))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Banner Title  </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('banner_title',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'banner_title','placeholder'=>'Banner Title','value'=>$menu['MenuPage']['banner_title']))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Banner Sub Text</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('banner_sub_text',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'banner_sub_text','placeholder'=>'Banner Sub Text','value'=>$menu['MenuPage']['banner_sub_text']))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Main Title</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('main_title',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'main_title','placeholder'=>'Main Title','value'=>$menu['MenuPage']['main_title']))?>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Content</label>
				<div class="col-sm-9">
					
					<?php echo $this->Form->input('content', array('type' => 'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5 ckeditor','id'=>'content','placeholder'=>'Content','value'=>$menu['MenuPage']['content']));?>
				</div>
			</div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Meta Description</label>
				<div class="col-sm-9">
					
					<?php echo $this->Form->input('meta_description', array('type' => 'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'meta_description','placeholder'=>'Meta Description','value'=>$menu['MenuPage']['meta_description']));?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Meta Title</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('meta_title',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'meta_title','placeholder'=>'Meta Title','value'=>$menu['MenuPage']['meta_title']))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Meta Keyword</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('meta_keywords',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'meta_keywords','placeholder'=>'Meta Keyword','value'=>$menu['MenuPage']['meta_keywords']))?>
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
				$("#page_name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter page name"
                });
				$("#display_name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter display name"
                });
				$("#banner_title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter banner title "
                });
				$("#banner_sub_text").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter banner sub text"
                });
				$("#main_title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter main title"
                });
				$("#meta_title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter meta title"
                });
				$("#meta_description").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter meta description"
                });
				$("#meta_keywords").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter meta keywords"
                });
				$("#content").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter content"
                });
			});
			
			CKEDITOR.replace('content', {
    filebrowserBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor',
    filebrowserImageBrowseUrl : '<?php echo SITEURL;?>app/webroot/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=image',
	filebrowserFlashBrowseUrl : '<?php echo SITEURL;?>js/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
	
	//filebrowserUploadUrl : 'ckeditor/pdw_file_browser/',
	//filebrowserImageUploadUrl : 'ckeditor/pdw_file_browser/',
	
    filebrowserWindowWidth  : 800,
    filebrowserWindowHeight : 500
});
			</script>