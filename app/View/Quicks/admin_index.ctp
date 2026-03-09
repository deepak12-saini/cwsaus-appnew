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
			
			<li class="active"><a href="<?php echo SITEURL.'admin/quicks';?>">Quick Quote List</a></li>
		</ul><!-- /.breadcrumb -->

	</div>
	<div class="page-content">
		<div class="page-header">
			<h1><!--Category-->Quick Quote<?php echo $this->Html->link('Add',array('controller' => 'quicks','action' => 'admin_add'),array('class'=>'btn btn-info btn-small top-button')); ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
			
				<th><?php echo $this->Paginator->sort('Title'); ?></th>
			
				<th><?php echo $this->Paginator->sort('Sub Text'); ?></th>
				 <th><?php echo $this->Paginator->sort('Type'); ?></th>
			
				 <th><?php echo $this->Paginator->sort('Description'); ?></th>
				 
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($QuickQuote as $QuickQuotes): ?>
					<tr>
					<td><?php echo h($QuickQuotes['QuickQuote']['title']); ?>&nbsp;</td>
					<td><?php echo h($QuickQuotes['QuickQuote']['sub_title']); ?>&nbsp;</td>
					<td><?php echo h($QuickQuotes['QuickQuote']['type']); ?>&nbsp;</td>
				
					<td><?php echo h($QuickQuotes['QuickQuote']['description']); ?>&nbsp;</td>
					
					 <td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $QuickQuotes['QuickQuote']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $QuickQuotes['QuickQuote']['id']),array('class'=>'btn btn-mini btn-danger')); ?>
						
						
						
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