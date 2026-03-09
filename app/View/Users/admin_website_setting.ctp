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
	<!-- <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script> -->
<div class="page-content">
	<div class="page-header">
	<h1>
	Website Setting
	<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Website Setting
	</small>
	</h1>
	</div><!-- /.page-header -->
	<div class="frmltmn">
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('Config',array('class'=>'form-horizontal')); ?>
		<div class="panel">
		<div class="panel-heading">Web Setting</div>
		
			
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Sitename : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('sitename',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'sitename','placeholder'=>'sitename'))?>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Siteurl : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('siteurl',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'siteurl','placeholder'=>'siteurl'))?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Email : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('email',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'email','placeholder'=>'email'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Admin Email : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('admin_email',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'email','placeholder'=>'email'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Support Email : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('support_email',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'support_email','placeholder'=>'Support Email'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">NoReply Email : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('reply_mail',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'reply_email','placeholder'=>'NoReply Email'))?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Address : </label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('address',array('type'=>'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-7','id'=>'address','placeholder'=>'Address'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Phone Number : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('phone',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'phone','placeholder'=>'phone'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Contact Email : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('footer_email',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'fax','placeholder'=>'Contact Email'))?>
					</div>
				</div>
				</div>
				<div class="panel">
					<div class="panel-heading">Footer Setting</div>
				<!--div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Address : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('address',array('type'=>'textarea','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'address','placeholder'=>'address'))?>
					</div>
				</div-->

				
				
				
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Twitter URL : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('twitter_url',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'twitter_url','placeholder'=>'Twitter URL'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Facebook URL : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('fb_url',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'facebook_url','placeholder'=>'Facebook URL'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Google Plus URL : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('gplus_url',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'googleplus_url','placeholder'=>'Google Plus URL'))?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="form-field-1">LinkedIn URL : </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('linkedin_url',array('type'=>'text','div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5',
						'id'=>'youtube_url','placeholder'=>'LinkedIn URL'))?>
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
	
				$("#sitename").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter site name"
                });$("#siteurl").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter site url"
                });$("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter email"
                });
				jQuery("#email").validate({
					expression: "if (VAL.match(\/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$\/) && VAL) return true; else return false;",
					message: "Please enter valid email"
				});
			}); 
			</script>