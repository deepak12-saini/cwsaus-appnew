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
			
			<li class="active"><a href="<?php echo SITEURL.'admin/states/stateprice';?>">StatePrice List</a></li>
		</ul><!-- /.breadcrumb -->

	</div>
	<div class="page-content">
		<div class="page-header">
			<h1><!--Category-->StatePrice <?php echo $this->Html->link('Add',array('controller' => 'states','action' => 'admin_stateprice_add'),array('class'=>'btn btn-info btn-mini top-button')); ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('Id'); ?></th>
				<th><?php echo $this->Paginator->sort('Min_Capacity'); ?>&nbsp;(Kw)</th>
				<th><?php echo $this->Paginator->sort('Max_Capacity'); ?>&nbsp;(Kw)</th>
				<th><?php echo $this->Paginator->sort('Amount'); ?>&nbsp;(INR)</th>
				<th><?php echo $this->Paginator->sort('Created'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($StatePrice as $StatePrices): ?>
					<tr>
					<td><?php echo h($StatePrices['StatePrice']['id']); ?>&nbsp;</td>
					<td><?php echo h($StatePrices['StatePrice']['min_capacity']); ?>&nbsp;</td>
					<td><?php echo h($StatePrices['StatePrice']['max_capacity']); ?>&nbsp;</td>
					<td><?php echo h($StatePrices['StatePrice']['amount']); ?>&nbsp;</td>
					<td><?php echo date('y-m-d H:i:s',strtotime($StatePrices['StatePrice']['created'])); ?>&nbsp;</td>
					 <td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'stateprice_edit', $StatePrices['StatePrice']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						<?php echo $this->Html->link(__('Delete'), array('action' => 'stateprice_delete', $StatePrices['StatePrice']['id']),array('class'=>'btn btn-mini btn-danger')); ?>
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