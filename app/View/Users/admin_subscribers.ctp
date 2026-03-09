		<div id="breadcrumbs" class="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL.'admin/users/dashboard'; ?>">Home</a>
		</li>
			<li class="active">Subscribers</li>
	</ul><!-- /.breadcrumb -->

	</div>	
	<div class="page-content">
		<div class="page-header">
			<h1>Subscribers List &nbsp;
<a href="/ezunik/admin/users/subscriber_export_csv" class="btn btn-mini">Export to CSV</a>
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<!--th><?php echo $this->Paginator->sort('name','Name'); ?></th-->
				<th><?php echo $this->Paginator->sort('email','Email'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($subscribers as $subscriber): ?>
					<tr>
					<td><?php echo h($subscriber['Newsletter']['id']); ?>&nbsp;</td>
					<!--td><?php echo h($subscriber['Newsletter']['name']); ?>&nbsp;</td-->
					<td><?php echo h($subscriber['Newsletter']['email']); ?>&nbsp;</td>
					<td><?php echo date('M d Y',strtotime($subscriber['Newsletter']['created'])); ?>&nbsp;</td>
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
'format' => __('Showing {:current} records out of {:count} entries')));?>	</div>
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