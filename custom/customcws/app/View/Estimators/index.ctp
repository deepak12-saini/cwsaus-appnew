<div class="page-content">
		<div class="page-header">
			<h1>Project Estimator
				<?php echo $this->Html->link('Add New',array('controller' => 'estimators','action' => 'addproject'),array('class'=>'btn btn-info btn-xs top-button')); ?>			
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('project_id','ProjectId'); ?></th>					
					<th><?php echo $this->Paginator->sort('project_name'); ?></th>			
					<th><?php echo $this->Paginator->sort('company'); ?></th>			
					<th><?php echo $this->Paginator->sort('client_name'); ?></th>			
					<th><?php echo $this->Paginator->sort('files'); ?></th>			
					
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($Estimators as $Estimator): ?>
					<tr>
						<td><a data-toggle="modal" data-target="#myModal_<?php echo $Estimator['Estimator']['project_id']; ?>" href="#null">#<?php echo h($Estimator['Estimator']['project_id']); ?></a>
						&nbsp;</td>				
						<td><?php echo h($Estimator['Estimator']['project_name']); ?>&nbsp;</td>					
						<td><?php echo h($Estimator['Estimator']['company']); ?>&nbsp;</td>					
						<td><?php echo h($Estimator['Estimator']['client_name']); ?>&nbsp;</td>					
						<td><a target="blank" href="<?php echo SITEURL.'eoi/'.$Estimator['Estimator']['files']; ?>">Download</a> &nbsp;</td>					
							
						<td> <?php echo date('d-M-Y h:i a',strtotime($Estimator['Estimator']['created'])); ?></td>					
						<td> 
						
						<a href="<?php echo SITEURL.'estimators/editproject/'.$Estimator['Estimator']['id']; ?>" class="btn btn-mini btn-success">Edit</a>
						
						<a data-toggle="modal" data-target="#myModal_<?php echo $Estimator['Estimator']['project_id']; ?>" href="#null" class="btn btn-mini btn-info">View</a>
						&nbsp; </td>					
					</tr>
					<?php endforeach; ?>

				</tbody>
			</table>			
			</div>
		</div>
	</div>		
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

<?php foreach ($Estimators as $Estimators){?>
	<div id="myModal_<?php echo $Estimators['Estimator']['project_id']; ?>" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Project Id: <?php echo h($Estimators['Estimator']['project_id']); ?></h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover"  >
					<tbody>
					<tr><th>ProjectId: </th><td><?php echo h($Estimators['Estimator']['project_id']); ?></td></tr>	
					<tr><th>Project Name: </th><td><?php echo h($Estimators['Estimator']['project_name']); ?></td></tr>	
					<tr><th>Company Name: </th><td><?php echo h($Estimators['Estimator']['company']); ?></td></tr>	
					<tr><th>Client Name: </th><td><?php echo h($Estimators['Estimator']['client_name']); ?></td></tr>	
					<tr><th>File: </th><td><a target="blank" href="<?php echo SITEURL.'eoi/'.$Estimator['Estimator']['files']; ?>">Download</a></td></tr>	
					<tr><th>Project Description: </th><td><?php echo htmlspecialchars_decode($Estimators['Estimator']['project_description']); ?></td></tr>	
					<tr><th>Result: </th><td><?php echo htmlspecialchars_decode($Estimators['Estimator']['estimate']); ?></td></tr>	
				
					</tbody>
					
				</table>
				

				</div>
			</div>
		</div>		
		  </div>
		 
		</div>

	  </div>
	</div>
	<?php } ?>