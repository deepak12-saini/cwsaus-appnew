
	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/quicks">Quick Quote</a></li>
			<li class="active">Add Quick Quote</li>
	</ul><!-- /.breadcrumb -->


</div>
<div class="page-content">
	<div class="page-header">
		<h1>Add Quick Quote <small><i class="ace-icon fa fa-angle-double-right"></i>Add Quick Quote </small></h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('QuickQuote',array('class'=>'form-horizontal')); ?>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('title',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'title','placeholder'=>'Title'))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sub Title  </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('sub_title',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'sub_title','placeholder'=>'Sub Title'))?>
				</div>
			</div>
		<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Type</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('type',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'type','placeholder'=>'2KW .....'))?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
				<div class="col-sm-9">
					
					<?php echo $this->Form->input('description', array('type' => 'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'description','placeholder'=>'Description'));?>
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
				$("#title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter page title"
                });
				$("#sub_title").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter sub title"
                });
				$("#type").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter  2Wk System "
                });
				$("#description").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter description"
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
			</script>