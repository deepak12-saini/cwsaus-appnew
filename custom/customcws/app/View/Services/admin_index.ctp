	<div class="page-content">
		<div class="page-header">
			<h1>Services <?php echo $this->Html->link('Add New',array('controller' => 'services','action' => 'admin_add'),array('class'=>'btn btn-info btn-small top-button')); ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('category_id','Category'); ?></th>
				<th><?php echo $this->Paginator->sort('service_name','Name'); ?></th>
				<th><?php echo $this->Paginator->sort('price','Price'); ?></th>
				 <th><?php echo $this->Paginator->sort('status'); ?></th>
                  <th><?php echo $this->Paginator->sort('created'); ?></th>

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($services as $service): ?>
					<tr>
					<td><?php echo h($service['Service']['id']); ?>&nbsp;</td>
					<td><?php echo h($service['Category']['category_name']); ?>&nbsp;</td>
					<td><?php echo h($service['Service']['service_name']); ?>&nbsp;</td>
					<td>£<?php echo h($service['Service']['price']); ?>&nbsp;</td>
					 <td>
						<?php if($service['Service']['status']==1){?>
							<span class="label label-success">Active</span>
						<?php }else{ ?>
						<span class="label label-danger">In Active</span>
						<?php }?>&nbsp;
						</td>
                    <td> <?php echo date('d-M-Y',strtotime($service['Service']['created'])); ?></td>
					 <td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $service['Service']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $service['Service']['id']),array('class'=>'btn btn-mini btn-warning')); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $service['Service']['id']), array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $service['Service']['id'])); ?>
						
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