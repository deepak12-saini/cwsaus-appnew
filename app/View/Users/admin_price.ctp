<style>
.panel{border:1px solid #ECECEC;margin-top:25px;margin-bottom:40px;box-shadow: 0 0 11px #d0d0d0;}
.panel-heading {
    background: #2B7DBC none repeat scroll 0 0;
    border: medium none;
    color: #ffffff;
    display: inline-block;
    float: none;
    font-weight: lighter;
    letter-spacing: 2px;
    margin: -41px 0 15px 10px;
    padding: 7px 51px;
    position: relative;
    text-transform: uppercase;
    top: -12px;
    width: auto;}

	
	</style>
<div class="page-content">
	<div class="page-header">
	<h1>
	Website Setting
	<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Price Page Setting
	</small>
	</h1>
	</div><!-- /.page-header -->
	<div class="frmltmn">
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Config',array('class'=>'form-horizontal')); ?>
		<div class="panel">
			<div class="panel-heading">Price Setting</div>
		
			
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Maintaince Fee : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('maintaince_fee',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'maintaince_fee','placeholder'=>'Maintaince Fee'))?>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Installation Fee : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('installation_fee',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'installation_fee','placeholder'=>'Installation Fee'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">5500 Filing Fee : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('filing_fee',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'filing_fee','placeholder'=>'5500 Filing Fee'))?>
					</div>
				</div>

				</div>
				
				<div class="form-group">
				<div class="col-md-offset-5 col-md-9">
					<?php echo $this->Form->submit('Submit',array('div'=>false,'label'=>false, 'class' => 'btn btn-success','id'=>'add_ser_prd_btn','value'=>'Submit'));?>&nbsp;
					<?php echo $this->Html->link('Cancel','javascript:window.history.back();',array('class' => 'btn btn-danger'));?>

				</div>
				
				</div>
			<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
	</div>
</div>
		<script type="text/javascript">
			jQuery(function(){ //short for $(document).ready(function(){
	
				$("#maintaince_fee").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter maintaince fee"
                });$("#installation_fee").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter installation fee"
                });$("#filing_fee").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter 5500 filing fee"
                });
			}); 
			</script>