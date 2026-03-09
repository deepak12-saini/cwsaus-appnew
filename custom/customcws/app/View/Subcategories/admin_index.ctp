	<div class="page-content">
		<div class="page-header">
			<h1>SubCategory Management <?php echo $this->Html->link('Add New',array('controller' => 'subcategories','action' => 'admin_add'),array('class'=>'btn btn-info btn-xs top-button')); ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('Category Name'); ?></th>
				<th><?php echo $this->Paginator->sort('name','SubCategory Name'); ?></th>
				 <th><?php echo $this->Paginator->sort('active'); ?></th>
                  <th><?php echo $this->Paginator->sort('created'); ?></th>

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($categories as $category): ?>
					<tr>
					<td>#<?php echo h($category['Subcategory']['id']); ?>&nbsp;</td>
					<td><?php echo h($category['Category']['category_name']); ?></td>
					<td><?php echo h($category['Subcategory']['name']); ?>&nbsp;</td>
					 <td>
						<?php if($category['Subcategory']['status']==1){?>
							<span class="label label-success">Active</span>
						<?php }else{ ?>
						<span class="label label-danger">Inactive</span>
						<?php }?>&nbsp;
						</td>
                    <td> <?php echo date('d-M-Y',strtotime($category['Subcategory']['created'])); ?></td>
					 <td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Subcategory']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Subcategory']['id']), array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $category['Subcategory']['id'])); ?>
						
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