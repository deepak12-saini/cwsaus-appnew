	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/states">State</a></li>
			<li class="active">Edit State</li>
	</ul><!-- /.breadcrumb -->


</div>
<div class="page-content">
	<div class="page-header">
		<h1>Edit State <small><i class="ace-icon fa fa-angle-double-right"></i>Edit State </small></h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('State',array('class'=>'form-horizontal')); ?>
			<input type="hidden" name="data[State][id]" value="<?php echo $State['State']['id'];?>" >
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Type</label>
				<div class="col-sm-9">
					
					<select name="data[State][type]" class="col-xs-10 col-sm-5" >
						<option value="0" <?php if($State['State']['type'] == '1') { ?> selected="selected"<? } ?>>Commercial </option>
						<option value="1" <?php if($State['State']['type'] == '1') { ?> selected="selected"<? } ?> >Domestic </option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">State </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('state',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'state','placeholder'=>'State','value'=>$State['State']['state']))?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> UnitPerRate </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('unit_per_rate',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'unit_per_rate','placeholder'=>'UnitPerRate','value'=>$State['State']['unit_per_rate']))?>
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
				$("#state").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter state"
                });
				$("#unit_per_rate").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter unit per rate"
                });
				
			});
			</script>