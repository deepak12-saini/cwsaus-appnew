
	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/stateprice">StatePrice</a></li>
			<li class="active">Add StatePrice</li>
	</ul><!-- /.breadcrumb -->


</div>
<div class="page-content">
	<div class="page-header">
		<h1>Add StatePrice <small><i class="ace-icon fa fa-angle-double-right"></i>Add StatePrice </small></h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('StatePrice',array('class'=>'form-horizontal')); ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Minimum Capacity (kw) </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('min_capacity',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'min_capacity','placeholder'=>'Minimum Capacity'))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Maximum Capacity (kw) </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('max_capacity',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'max_capacity','placeholder'=>'Maximum Capacity'))?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount  </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('amount',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'amount','placeholder'=>'Amount'))?>
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
				$("#amount").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter amount"
                });
				$("#min_capacity").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter minimum capacity"
                });$("#max_capacity").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter maximum capacity"
                });
				
			});
			</script>