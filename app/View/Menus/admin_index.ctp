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
			
			<li class="active"><a href="<?php echo SITEURL.'admin/menus';?>">Menu List</a></li>
		</ul><!-- /.breadcrumb -->

	</div>
	<div class="page-content">
		
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
			
				<th><?php echo $this->Paginator->sort('Display Title'); ?></th>
				<th><?php echo $this->Paginator->sort('Banner Title'); ?></th>
				<th><?php echo $this->Paginator->sort('Banner Sub Text'); ?></th>
				 <th><?php echo $this->Paginator->sort('Main Title'); ?></th>
				 <th><?php echo $this->Paginator->sort('Meta Title'); ?></th>
				 <th><?php echo $this->Paginator->sort('Meta Description'); ?></th>
				 <th><?php echo $this->Paginator->sort('Meta Keyword'); ?></th> 
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($MenuPage as $MenuPages): ?>
					<tr>
					<td><?php echo h($MenuPages['MenuPage']['display_name']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['banner_title']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['banner_sub_text']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['main_title']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['meta_title']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['meta_description']); ?>&nbsp;</td>
					<td><?php echo h($MenuPages['MenuPage']['meta_keywords']); ?>&nbsp;</td>
					 <td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $MenuPages['MenuPage']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						
						
						
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