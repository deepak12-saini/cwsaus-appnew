<script src="<?php echo SITEURL; ?>ckeditor/ckeditor.js"></script>
<div class="page-content">
	<div class="page-header">
	<h1>
	Non Conformance 
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		
	</small>
	</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('Conformance',array('class'=>'form-horizontal')); ?>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Non Conformance: </label>
					<div class="col-sm-9">
						<textarea  readonly style="width:90%; height:120px; background:#e2e2e2;"  class='col-xs-10 col-sm-5' placeholder="Non Conformance" id='non_conforance' disabled ><?php echo $conformanceArr['Conformance']['non_conforance'];?></textarea>
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Corrective Action Taken: </label>
					<div class="col-sm-9">
						<textarea readonly style="width:90%; height:120px;  background:#e2e2e2;" class='col-xs-10 col-sm-5' placeholder="Corrective Action Taken" id='corrective_action_taken'><?php echo $conformanceArr['Conformance']['corrective_action_taken'];?></textarea>			
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Preventive Action: </label>
					<div class="col-sm-9">
						<textarea  readonly style="width:90%; height:120px;  background:#e2e2e2;"  class="col-xs-10 col-sm-5" 
						placeholder="Preventive Action" id='preventive_action'><?php echo $conformanceArr['Conformance']['preventive_action'];?></textarea>						
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Management: </label>
					<div class="col-sm-9">
						<textarea  style="width:90%; height:120px;" name="data[Conformance][management_representive]" class='col-xs-10 col-sm-5' placeholder="Management" id='management_representive'><?php echo $conformanceArr['Conformance']['management_representive'];?></textarea>			
						
					</div>
				</div>
				<div class="form-group">
					<label for="form-field-2" class="col-sm-3 control-label no-padding-right">NC Status : </label>
						<div class="col-sm-9">
						<?php if($conformanceArr['Conformance']['status'] == 1) { $sactive='checked'; $active=''; $inactive='';}else if($conformanceArr['Conformance']['status'] == 2) { $sactive=''; $active='checked';$inactive='';}else if($conformanceArr['Conformance']['status'] == 3) {  $sactive=''; $active='';$inactive='checked';}?>
						
						<div class="radio"><label>
						<input type="radio"  value="1" <?php echo $sactive; ?>  class="ace" id="ServiceCategoryActive1" name="data[Conformance][status]"><span class="lbl"> Pending</span>
						</label></div>
						
						<div class="radio"><label>
						<input type="radio"  value="2" <?php echo $active; ?>  class="ace" id="ServiceCategoryActive1" name="data[Conformance][status]"><span class="lbl"> In-Process</span>
						</label></div>
						
						<div class="radio"><label>
							<input type="radio" value="3" class="ace" <?php echo $inactive; ?> id="ServiceCategoryActive0" name="data[Conformance][status]"><span class="lbl"> Completed</span>
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
	jQuery(function(){ 
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',			
		});
		
		$("#management_representive").validate({
			 expression: "if (VAL) return true; else return false;",
			message: "Please enter management representive"
		});  
	});
</script>