	<!-- #section:basics/content.breadcrumbs -->
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
		try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="<?php echo SITEURL ?>">Home</a>
			</li>
			
			<li class="active"><a href="<?php echo SITEURL.'users';?>">Admin User List</a></li>
			<li class="active">Edit User</li>
		</ul><!-- /.breadcrumb -->

	</div>
	<div class="page-content">
		<div class="page-header">
			<div class="right_btn pull-right" ><a href="javascript:window.history.back();" class="btn btn-inverse" >Back</a></div>
			<h1>Admin User  <small><i class="ace-icon fa fa-angle-double-right"></i> Edit User</small>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<?php echo $this->Form->create('User',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
			<?php echo $this->Form->input('id',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','type'=>'hidden'))?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('name',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Enter name'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('username',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'username','placeholder'=>'Enter username'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('password',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'password','placeholder'=>'Enter password'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('email',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'email','placeholder'=>'Enter email'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('phone',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'phone','placeholder'=>'Enter phone'))?>
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Address : </label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('address',array('div'=>false,'label'=>false, 'class' => 'col-xs-10 col-sm-5','id'=>'email','placeholder'=>'Enter address'))?>
				</div>
			</div>	
			<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Status : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio"  value="1" <?php if($user['User']['status'] == 1){ ?> checked="checked" <?php  } ?> class="ace" id="UserActive1" name="data[User][status]"><span class="lbl"> Active</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['status'] == 0){ ?> checked="checked" <?php  } ?> class="ace" id="UserActive0" name="data[User][status]"><span class="lbl"> Inactive</span>
				</label></div>				
				</div>
			</div>	
			<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Send Notification : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio"  value="1" class="ace" id="UserActive1" name="data[noti]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0" checked  class="ace" id="UserActive0" name="data[noti]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div>	
			<input type="hidden"  value="1"   name="data[User][permission_to_view]">
			<!-- <div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To View Detail : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" value="1"  <?php if($user['User']['permission_to_view'] == 1){ ?> checked="checked" <?php  } ?>  class="ace" id="permission_to_view" name="data[User][permission_to_view]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_view'] == 0){ ?> checked="checked" <?php  } ?>  class="ace" id="permission_to_view" name="data[User][permission_to_view]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div> -->
				<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To Add : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" <?php if($user['User']['permission_to_add'] == 1){ ?> checked="checked" <?php  } ?>  value="1"  class="ace" id="permission_to_add" name="data[User][permission_to_add]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_add'] == 0){ ?> checked="checked" <?php  } ?> class="ace" id="permission_to_add" name="data[User][permission_to_add]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div>
				<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To Edit : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" <?php if($user['User']['permission_to_edit'] == 1){ ?> checked="checked" <?php  } ?> value="1"  class="ace" id="permission_to_edit" name="data[User][permission_to_edit]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_edit'] == 0){ ?> checked="checked"  <?php  } ?>  class="ace" id="permission_to_edit" name="data[User][permission_to_edit]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div>
				<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To Delete : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" <?php if($user['User']['permission_to_delete'] == 1){ ?> checked="checked" <?php  } ?>  value="1"  class="ace" id="permission_to_delete" name="data[User][permission_to_delete]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_delete'] == 0){ ?> checked="checked" <?php  } ?>  class="ace" id="permission_to_delete" name="data[User][permission_to_delete]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div>
				<div class="form-group">
			<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To export : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" <?php if($user['User']['permission_to_export'] == 1){ ?> checked="checked" <?php  } ?>  value="1"  class="ace" id="permission_to_export" name="data[User][permission_to_export]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_export'] == 0){ ?> checked="checked" <?php  } ?>   class="ace" id="permission_to_export" name="data[User][permission_to_export]"><span class="lbl"> No</span>
				</label></div>				
				</div>
			</div>
				<div class="form-group">
				<label for="form-field-2" class="col-sm-3 control-label no-padding-right"> Allow To Upload Doc : </label>
				<div class="col-sm-9">		
				
				<div class="radio"><label>
				<input type="radio" <?php if($user['User']['permission_to_upload'] == 1){ ?> checked="checked" <?php  } ?>  value="1"  class="ace" id="permission_to_upload" name="data[User][permission_to_upload]"><span class="lbl"> Yes</span>
				</label></div>
				
				<div class="radio"><label>
					<input type="radio" value="0"  <?php if($user['User']['permission_to_upload'] == 0){ ?> checked="checked" <?php  } ?>   class="ace" id="permission_to_upload" name="data[User][permission_to_upload]"><span class="lbl"> No</span>
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
<script type="text/javascript">
			jQuery(function(){ //short for $(document).ready(function(){

				$("#name").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter name"
                }); $("#username").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please select username"
                }); $("#password").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please select password"
                }); $("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please select email"
                }); $("#email").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please select email"
                }); jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid Email ID"
                });$("#password").validate({
                     expression: "if (VAL) return true; else return false;",
                    message: "Please enter password"
                });
				
			});
			</script>
