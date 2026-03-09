<script src="<?php echo SITEURL; ?>ckeditor/ckeditor.js"></script>	
<style> 
.btn-toolbar{ top:0px!important; z-index:0px!important}
body {
    display: hhh !important;
    flex-direction: none;
}
</style>
	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/blogs">Blogs</a></li>
			<li class="active">Edit Blog</li>
	</ul><!-- /.breadcrumb -->


</div>
	<div class="page-content">
		<div class="page-header">
		<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
		<h1>Blogs <small><i class="ace-icon fa fa-angle-double-right"></i>	Edit Blog </small>
		</h1>
	</div>

	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Blog',array('enctype'=>'multipart/form-data','class'=>'form-horizontal','id'=>'AddPageForm')); ?>			
			<input type="hidden" name="data[Blog][org_image]" value="<?php echo $Blog['Blog']['title_image'];?>">
			<input type="hidden" name="data[Blog][id]" value="<?php echo $Blog['Blog']['id'];?>">
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Category : </label>
				<div class="col-sm-4">
					<select  name="data[Blog][category_id]" id="category_id" class="form-control" >
					<option value="0" >Select Category</option>
					<?php 	foreach($cate as $cates){ ?>
					<option value="<?php echo $cates['Category']['id'];?>" <?php if($cates['Category']['id'] == $Blog['Blog']['category_id']){ ?> selected="selected" <?php  } ?> ><?php echo $cates['Category']['name'];?></option>
					<?php } ?>
					</select>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('title',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'title','placeholder'=>'Title'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('description',array('div'=>false,'label'=>false, 'class' => 'ckeditor col-xs-10 col-sm-5','id'=>'content','type'=>'textarea','style'=>'width: 100%'))?>
				</div>	
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title Image : </label>
				<div class="col-sm-9">
				
					<?php if($Blog['Blog']['title_image']!=''){?>
					<br>
					<img src="<?php echo SITEURL.'blog_img/'.$Blog['Blog']['title_image'];?>" width="100">
					<br>
					<a href="<?php echo SITEURL.'admin/blogs/delete_image/'.$Blog['Blog']['id'];?>">Delete</a>
					<?php }else{ ?>
						<input type="file" name="data[Blog][image]" id="image" cols="50">
					<?php }?>
				</div>				
			</div>	
			<!-- <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Author : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('author',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'author','placeholder'=>'Author'))?>
				</div>
			</div>		 -->		
			<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
			
			<div class="col-sm-9">	
				
				<div class="radio"><label>
				<input type="radio" <?php if($Blog['Blog']['status'] == 1) { ?> checked="checked" <?php  } ?> value="1"  class="ace" id="CategoryActive1" name="data[Blog][status]">
				<span class="lbl">Active</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" <?php if($Blog['Blog']['status'] == 0) { ?> checked="checked" <?php  } ?>  value="0"  class="ace" id="CategoryActive0" name="data[Blog][status]">
					<span class="lbl">InActive</span>
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
</div>	

<script type="text/javascript">

	jQuery(function(){ //short for $(document).ready(function(){
	
		$("#category_id").validate({
			 expression: "if (VAL>0) return true; else return false;",
			message: "Please select category"
		});$("#title").validate({
			 expression: "if (VAL) return true; else return false;",
			message: "Please enter title"
		});  $("#author").validate({
			 expression: "if (VAL) return true; else return false;",
			message: "Please enter author"
		});  
	});
</script>