	<div class="page-content">
		<div class="page-header">
			<h1>
			Duro Sales Team
				<a href="<?php echo SITEURL.'admin/users/staff'?>" class="btn btn-mini btn-danger" style="float:right;">Give Sale Permssion To Staff</a>
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('mobile_number'); ?></th>
				<th><?php echo $this->Paginator->sort('department'); ?></th>				
				<th><?php echo $this->Paginator->sort('status'); ?></th>				
               

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($staff as $staffs): ?>
					<tr>
					<td>#<?php echo h($staffs['NappUser']['id']); ?>&nbsp;</td>
					<td><?php echo $staffs['NappUser']['name'].' '.$staffs['NappUser']['lname']; ?>&nbsp;</td>
					<td><?php echo h($staffs['NappUser']['email']); ?>&nbsp;</td>
					<td><?php echo h($staffs['NappUser']['mobile_number']); ?>&nbsp;</td>
					<td><?php echo h($staffs['Department']['department_title']); ?>&nbsp;</td>					
					<td>
					<?php if($staffs['NappUser']['is_approved']==1){?>
						<span class="label label-success">Approved</span>
					<?php }else{ ?>
					<span class="label label-danger">Not Approve</span>
					<?php }?>&nbsp;
					</td>
                    <td>
						<a href="<?php echo SITEURL.'admin/sales/settarget/'.$staffs['NappUser']['id']; ?>" class="btn btn-mini btn-warning"  >Set Target</a>
						<a href="<?php echo SITEURL.'admin/sales/report/'.$staffs['NappUser']['id']; ?>" class="btn btn-mini btn-danger"  >Report</a>
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