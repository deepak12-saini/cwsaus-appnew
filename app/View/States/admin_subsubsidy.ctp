
	<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class=""><a href="<?php echo SITEURL; ?>admin/states/subsubsidy">Calculator Settings</a></li>
			<li class="active"><?php if(!empty($Subsubsidy['Subsubsidy']['id'])){?> Edit Settings<?php }else{?> Add Settings<?php }?></li>
	</ul><!-- /.breadcrumb -->


</div>
<div class="page-content">
	<div class="page-header">
		<h1><?php if(!empty($Subsubsidy['Subsubsidy']['id'])){?> Edit Settings<?php }else{?> Add Settings<?php }?> <small><i class="ace-icon fa fa-angle-double-right"></i><?php if(!empty($Subsubsidy['Subsubsidy']['id'])){?> Edit Settings<?php }else{?> Add Settings<?php }?> </small></h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('Subsubsidy',array('class'=>'form-horizontal')); ?>
			<?php if(!empty($Subsubsidy['Subsubsidy']['id'])){?>
				<input type="hidden" name="data[Subsubsidy][id]" value="<?php echo $Subsubsidy['Subsubsidy']['id'];?>" >
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kw</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('subsidy',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'subsidy','placeholder'=>'Subsubsidy','value'=>$Subsubsidy['Subsubsidy']['subsidy']))?>
					</div>
				</div>
				<div class="form-group" style="display:none;">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Govt. Subsidy Percent(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('govt_subsidy_percent',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'govt_subsidy_percent','placeholder'=>'Govt. Subsidy Percent','value'=>$Subsubsidy['Subsubsidy']['govt_subsidy_percent']))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Per Unit Kw</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('per_kw_unit',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'per_kw_unit','placeholder'=>'Per Unit Kw','value'=>$Subsubsidy['Subsubsidy']['per_kw_unit']))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Govt increase electricity unit rate(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('unit_rate_percentage',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'unit_rate_percentage','placeholder'=>'Govt increase electricity unit rate','value'=>$Subsubsidy['Subsubsidy']['unit_rate_percentage']))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Efficiency decrease percentage(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('efficiency_decrease_percentage',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'efficiency_decrease_percentage','placeholder'=>'Efficiency decrease percentage','value'=>$Subsubsidy['Subsubsidy']['efficiency_decrease_percentage']))?>
					</div>
				</div>
			<?php }else{?>
			
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kw</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('subsidy',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'subsidy','placeholder'=>'Subsubsidy'))?>
					</div>
				</div>
				<div class="form-group" style="display:none;">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Govt. Subsidy Percent(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('govt_subsidy_percent',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'govt_subsidy_percent','placeholder'=>'Govt. Subsidy Percent'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Per Unit Kw</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('per_kw_unit',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'per_kw_unit','placeholder'=>'Per Unit Kw'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Govt increase electricity unit rate(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('unit_rate_percentage',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'unit_rate_percentage','placeholder'=>'Govt increase electricity unit rate'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Efficiency decrease percentage(%)</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('efficiency_decrease_percentage',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'efficiency_decrease_percentage','placeholder'=>'Efficiency decrease percentage'))?>
					</div>
				</div>
			<?php }?>
			
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<?php if(!empty($Subsubsidy['Subsubsidy']['id'])){?>
						<?php echo $this->Form->submit('Update',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					<?php }else{?>
						<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					<?php }?>
					<?php echo $this->Html->link('Cancel','javascript:window.history.back();',array('class' => 'btn btn-danger'));?>

				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
		<script type="text/javascript">
			jQuery(function(){ //short for $(document).ready(function(){
				$("#subsidy").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter Subsubsidy"
                });
				
				
			});
			</script>