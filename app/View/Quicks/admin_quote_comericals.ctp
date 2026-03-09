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
			
			<li class="active"><a href="<?php echo SITEURL.'admin/quicks/quote_comericals';?>">Quote  Comerical List</a></li>
		</ul><!-- /.breadcrumb -->

	</div>
	<div class="page-content">
		<div class="page-header">
			<h1>Quote Comerical List &nbsp;&nbsp;
			
			
		
				
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
			
				<th><?php echo $this->Paginator->sort('Unique Id'); ?></th>
			
				<th><?php echo $this->Paginator->sort('Name'); ?></th>
				 <th><?php echo $this->Paginator->sort('Email'); ?></th>
			
				 <th><?php echo $this->Paginator->sort('Phone'); ?></th>
				 <th><?php echo $this->Paginator->sort('Address'); ?></th>
				 <th><?php echo $this->Paginator->sort('Pin Code'); ?></th>
				 <th><?php echo $this->Paginator->sort('Note'); ?></th>
				 <th><?php echo $this->Paginator->sort('Created'); ?></th>
				 
				
				</tr>
				</thead>
				<tbody>
						<?php foreach ($QuoteComerical as $QuoteComericals): ?>
					<tr>
					<td><?php echo h($QuoteComericals['QuoteComerical']['uniqueid']); ?>&nbsp;</td>
					<td><?php echo h($QuoteComericals['QuoteComerical']['fullname']); ?>&nbsp;</td>
					<td><?php echo h($QuoteComericals['QuoteComerical']['email']); ?>&nbsp;</td>
				
					<td><?php echo h($QuoteComericals['QuoteComerical']['phone']); ?>&nbsp;</td>
					<td><?php echo h($QuoteComericals['QuoteComerical']['address']); ?>&nbsp;</td>
					<td><?php echo h($QuoteComericals['QuoteComerical']['pincode']); ?>&nbsp;</td>
					<td><?php echo h($QuoteComericals['QuoteComerical']['note']); ?>&nbsp;</td>
					<td><?php echo date('y-m-d H:i:s',strtotime($QuoteComericals['QuoteComerical']['created'])); ?>&nbsp;</td>
					
					
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