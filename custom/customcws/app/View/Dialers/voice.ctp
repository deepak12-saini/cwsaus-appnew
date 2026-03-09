<div class="page-content">
	<div class="page-header">
		<h1>Logs</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>				
					<th><?php echo $this->Paginator->sort('id'); ?></th>				
					<th><?php echo $this->Paginator->sort('phone_number'); ?></th>				
					<th><?php echo $this->Paginator->sort('voice_url'); ?></th>
					<th><?php echo $this->Paginator->sort('call_duration'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($logs as $log): ?>
					<tr>
						<td><?php echo h($log['Log']['id']); ?></td>
						<td><?php echo h($log['Lob']['phone_number']); ?></td>	
						<td><?php echo h($log['Lob']['voice_url']); ?></td>	
						<td><?php echo h($log['Lob']['call_duration']); ?></td>	
						<td><?php echo h($log['Lob']['status']); ?></td>	
						<td><?php echo h($log['Lob']['created']); ?></td>	
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>			
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-xs-6">
			<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite"><?php	echo $this->Paginator->counter(array('format' => __('showing {:current} records out of {:count} entries')));?>	</div>
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