	<div class="page-content">
		<div class="page-header">
			<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
			<h1>Category<small><i class="ace-icon fa fa-angle-double-right"></i> Edit Category</small>
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->Form->create('Subcategory',array('class'=>'form-horizontal'));echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category: </label>
				<div class="col-sm-8">
				
				
				
				
				
				
				
				
					<select class="col-xs-10 col-sm-5" name="data[Subcategory][category_id]">
						<?php foreach($category as $category_arr){?>
							<option value="<?php echo $category_arr['Category']['id']?>"  <?php if($category_arr['Category']['id']== $Subcategory['Subcategory']['category_id']){ echo 'selected';}?>   ><?php echo $category_arr['Category']['category_name']?></option>
						<?php }?>
					</select>

				</div>
			</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'category_name','placeholder'=>'Sub Category Name'))?>
					</div>
				</div>
				<div class="form-group">
					<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
						<div class="col-sm-9">
						<?php if($Subcategory['Subcategory']['status'] == 1) { $active='checked';$inactive='';}else{  $active='';$inactive='checked';}?>
						
						<div class="radio"><label>
						<input type="radio"  value="1" <?php echo $active; ?>  class="ace" id="ServiceCategoryActive1" name="data[Subcategory][status]"><span class="lbl"> Active</span>
						</label></div>
						
						<div class="radio"><label>
							<input type="radio" value="0" class="ace" <?php echo $inactive; ?> id="ServiceCategoryActive0" name="data[Subcategory][status]"><span class="lbl"> Inactive</span>
						</label></div>
						
						
					</div>
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
                    message: "Please enter  subcategory name"
                }); 
			});
			</script>
