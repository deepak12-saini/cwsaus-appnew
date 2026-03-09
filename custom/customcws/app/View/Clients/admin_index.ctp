	<style>
		select {
			padding: 0px 4px;
			height: 29px;
			width: 205px;
			font-size: 14px;
		}
		.label {			
			margin-top: 5px;
		}
	</style>
	<div class="page-content">
		<div class="page-header">
			<h1>Clients Management 
			
			<?php echo $this->Html->link('Import csv',array('controller' => 'clients','action' => 'admin_import'),array('class'=>'btn btn-danger btn-xs top-button')); ?>
			<?php echo $this->Html->link('Add New',array('controller' => 'clients','action' => 'admin_add'),array('class'=>'btn btn-info btn-xs top-button')); ?>
			<!-- Trigger the modal with a button -->
			<button type="button" class="btn btn-warning btn-xs top-button" data-toggle="modal" data-target="#myModal">Client Category</button>		


			<form action="" method="post" style="float:right;">
				<select name="data[client_id]" style="width:160px;">
					<option value="">Select Sales Person </option>
					<?php foreach($cuser as $cusers){ ?>
						<option <?php if($client_id == $cusers['NappUser']['id']){  echo 'selected'; } ?>  value="<?php echo $cusers['NappUser']['id']; ?>"><?php echo $cusers['NappUser']['name'].' '.$cusers['NappUser']['name']; ?></option>
					<?php  } ?>
				</select>
				<select name="data[category_id]" style="width:160px;">
					<option value="">Select Category </option>
					<?php foreach($ClientTypeArr as $ClientTypeArrs){ ?>
						<option <?php if($category_id == $ClientTypeArrs['ClientType']['id']){ echo 'selected'; } ?> value="<?php echo $ClientTypeArrs['ClientType']['id']; ?>"><?php echo $ClientTypeArrs['ClientType']['name']; ?></option>
					<?php  } ?>
				</select>
				<input type="search" name="search" placeholder="Search  name or email or phone" value="<?php echo $search; ?>" style="width:220px">
				<input type="submit"  class="btn btn-xs btn-primary" value="Search">
				
				<a class="btn btn-xs btn-warning" href="<?php echo SITEURL.'admin/clients/index/clear'; ?>" >Clear All</a>
			</form>
				
			</h1>
			
			
		</div>
	
	<form action="<?php echo SITEURL.'admin/clients/assign'?>" method="post">
	<div style="margin-bottom:10px;">
	<select name="data[client_id]" onchange="selected(this.value)">
		<option value="">Select Sales Person </option>
		<?php foreach($cuser as $cusers){ ?>
			<option <?php if($clientId == $cusers['NappUser']['id']){  echo 'selected'; } ?>  value="<?php echo $cusers['NappUser']['id']; ?>"><?php echo $cusers['NappUser']['name'].' '.$cusers['NappUser']['name']; ?></option>
		<?php  } ?>
	</select>
	<input type="submit"  class="btn btn-xs btn-info" value="Assign Client" style="margin-bottom:4px;">
	</div>
	<div class="row">
	
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><input type="checkbox" id="ckbCheckAll" ></th>
				<th><?php echo $this->Paginator->sort('chat'); ?></th>
				<!-- <th><?php echo $this->Paginator->sort('id'); ?></th> -->
				
				<th><?php echo $this->Paginator->sort('Category_id','Category Name'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th>#<?php echo $this->Paginator->sort('mobile'); ?></th>
				<th>#<?php echo $this->Paginator->sort('landline'); ?></th>
				<th><?php echo $this->Paginator->sort('company'); ?></th>
				<th><?php echo $this->Paginator->sort('Assign Staff'); ?></th>
				<!-- th><?php echo $this->Paginator->sort('job_title'); ?></th-->
				<th><?php echo $this->Paginator->sort('address'); ?></th>				
                
                <th><?php echo $this->Paginator->sort('status'); ?></th>

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
					
						<?php $i=1; foreach ($clientArr as $clientArrs): ?>
						 
							<tr>
							<td>
								<input type="checkbox" <?php if(in_array($clientArrs['Client']['id'],$StaffClientArr)){ echo 'checked'; } ?> class="checkBoxClass"   value="<?php echo $clientArrs['Client']['id']; ?>" name="selectids[]" >
							</td>
							<td><a href="#null"  onclick="openpoup(<?php echo $clientArrs['Client']['id']; ?>)"><i class="fa fa-comment"></i></a></td>
							
							<!-- <td>#<?php echo h($clientArrs['Client']['id']); ?>&nbsp;</td> -->
							<td><b><?php echo h($clientArrs['ClientType']['name']); ?></b>&nbsp;</td>
							<td>
							<?php if(!empty($clientArrs['Client']['fname'])){ echo $clientArrs['Client']['fname']; }else{ echo '--'; } ?> 
							</td>
							<td><?php echo $clientArrs['Client']['email']; ?>&nbsp;</td>
							<td><?php echo $clientArrs['Client']['mobile']; ?>&nbsp;</td>
							<td><?php echo $clientArrs['Client']['landline']; ?>&nbsp;</td>
							<td><?php echo $clientArrs['Client']['company']; ?>&nbsp;</td>
							<td>
								<?php
								$cleintname = '';	
								if(!empty($clientArrs['StaffClient'])){
									foreach($clientArrs['StaffClient'] as $StaffClients){									
									$cleintname .= '<span class="label label-info">'.$StaffClients['NappUser']['name'].' '.$StaffClients['NappUser']['lname'].'</span>';
								} } 
								echo $cleintname;
								?>
							</td>
							<!-- <td><?php echo h($clientArrs['Client']['job_title']); ?>&nbsp;</td> -->
							<td>
							<b><?php echo h($clientArrs['Client']['address1']); ?></b>		
						
							<!-- City:&nbsp; <?php echo h($clientArrs['Client']['city']); ?><br>
							State:&nbsp; <?php echo h($clientArrs['Client']['state']); ?><br>
							Zip:&nbsp; <?php echo h($clientArrs['Client']['zip']); ?><br>
							Country:&nbsp; <?php echo h($clientArrs['Client']['country']); ?><br>
							 -->
							</td>		
						
							<td><?php if($clientArrs['Client']['status'] == 1){ echo '<span class="label label-success">Active</span>'; }else{  '<span class="label label-danger">Deactive</span>'; } ?>&nbsp;</td>
							<td>
								<?php echo $this->Html->link('Edit',array('controller' => 'clients','action' => 'admin_edit/'.$clientArrs['Client']['id']),array('class'=>'btn btn-primary btn-xs top-button')); ?>
							</td>
							
							</tr>
							
							
							
							
						<?php $i++; endforeach; ?>
					
				</tbody>
			</table>			
			</div>
		</div>
	</div>		
	</form>
	<div class="row">
		<div class="col-xs-6">
			<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite"><?php	echo $this->Paginator->counter(array(
'format' => __('showing {:current} records out of {:count} entries')));?>	</div>
		</div>
		<div class="col-xs-6">
			<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
			<ul class="pagination">
				<li class="paginate_button previous disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><?php
				echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));?></li>
				
				<li class="paginate_button next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next"><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));?></li>
				
			</ul>
			</div>
		</div>
	</div>	
</div>		
<a href="#null"  data-toggle="modal" data-target="#myModal_new" id="myModalNew"><i></i></a>
<div id="myModal_new" class="modal fade" role="dialog" >
  <div class="modal-dialog">


	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Client Comments  </h4>
	  </div>
	  <div class="modal-body">
			<iframe src="" id="abc_frame" style="width:100%; border:none; height:400px;"></iframe>
	  </div>      
	</div>

  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="height:500px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Client Category </h4>
      </div>
      <div class="modal-body">
			<iframe src="<?php echo SITEURL.'admin/clients/clienttype'; ?>" style="width:100%; border:none; height:400px;"></iframe>
      </div>      
    </div>

  </div>
</div>
<script>

function openpoup(id){
	var url = '<?php echo SITEURL.'admin/clients/comment/' ?>'+id;
	$('#abc_frame').attr('src', url);
	$("#myModalNew").trigger('click');	
}

function selected(id){
	window.location.href = "<?php echo SITEURL.'admin/clients/index/'?>"+id;
}

$(document).ready(function () {
	$('#ckbCheckAll').on('click',function(){
		if(this.checked){
			$('.checkBoxClass').each(function(){
				this.checked = true;
			});
		}else{
			 $('.checkBoxClass').each(function(){
				this.checked = false;
			});
		}
	});
});
</script>