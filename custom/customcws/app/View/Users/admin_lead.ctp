	
<style>
.btn{margin-bottom: 5px; }
.label {
    margin-bottom: 5px;
}
</style>
	
	<div class="page-content">

		<div class="page-header">
			<h1>New Called Lead </h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				
				<th><?php echo $this->Paginator->sort('id'); ?></th>				
				<th><?php echo $this->Paginator->sort('FromNumber','From Number'); ?></th>				
				<th><?php echo $this->Paginator->sort('CallerCountry'); ?></th>				
				<th><?php echo $this->Paginator->sort('CalledState'); ?></th>				
				<th><?php echo $this->Paginator->sort('CallerZip'); ?></th>
				<th><?php echo $this->Paginator->sort('CallStatus'); ?></th>
				<th><?php echo $this->Paginator->sort('Direction'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($LeadArr as $LeadArrs): ?>
					<tr>					
						<td><?php echo h($LeadArrs['Lead']['id']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['FromNumber']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['CallerCountry']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['CalledState']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['CallerZip']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['CallStatus']); ?>&nbsp;</td>								
						<td><?php echo h($LeadArrs['Lead']['Direction']); ?>&nbsp;</td>								
						<td>
						<?php 
						if($LeadArrs['Lead']['status'] == 1){
							echo '<span class="label label-danger">New</span>';
						}else{
							echo '<span class="label label-success">Completed</span>';
						}	
						
						?>&nbsp;</td>
						<td><?php echo date('D M Y h:s a',strtotime($LeadArrs['Lead']['created'])); ?>&nbsp;</td>		
						<td>
							<?php 	if($LeadArrs['Lead']['status'] == 1){ ?>
								<a class="btn btn-mini btn-info" href="<?php echo SITEURL.'admin/users/updatestatus/'.$LeadArrs['Lead']['id'] ?>">Complete</a>	
							<?php  } ?>
						</td>	
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