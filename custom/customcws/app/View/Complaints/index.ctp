	
	<style>
		.btn{margin-bottom: 5px; }
		.label-danger, .label.label-danger, .badge.badge-danger, .badge-danger {
			margin-bottom: 5px;
		}
	</style>
	
	<div class="page-content">
	<div class="page-header">
		<h1>Complaint List
			<a href="<?php echo SITEURL.'complaints/add'?>" class="btn btn-mini btn-info">Create Complaint</a>
		</h1>
	</div>
	
	<?php
		$name = $this->Session->read('Customer.name').' '.$this->Session->read('Customer.lname');
	?>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>				
					<th><?php echo $this->Paginator->sort('complaint_id','Complaint Id'); ?></th>							
					<th><?php echo $this->Paginator->sort('customer_name','Customer'); ?></th>										
					<th><?php echo $this->Paginator->sort('emp_id','Compaint By'); ?></th>
					<th><?php echo $this->Paginator->sort('compaint_to','Compaint Against'); ?></th>
					<th><?php echo $this->Paginator->sort('dept_id'); ?></th>
					<th><?php echo $this->Paginator->sort('product_name'); ?></th>
					<th><?php echo $this->Paginator->sort('product_color'); ?></th>							
					<th><?php echo $this->Paginator->sort('complaint_type'); ?></th>
					<th><?php echo $this->Paginator->sort('reason_for_complaint'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>				
					<th>Action</th>				
					
				</tr>
				</thead>
				<tbody>
				<?php 
				foreach ($ComplaintArr as $ComplaintArrs): 				
				?>
					<tr>
						<td><?php echo h($ComplaintArrs['Complaint']['complaint_id']); ?></td>					
									
						<td>
						<?php echo 'Name: <b>'.ucfirst($ComplaintArrs['Complaint']['customer_name']).'</b>'; ?><br/>
						<?php echo 'Email: <b>'.ucfirst($ComplaintArrs['Complaint']['customer_email']).'</b>'; ?><br/>
						<?php echo 'Phone: <b>'.ucfirst($ComplaintArrs['Complaint']['customer_phone']).'</b>'; ?><br/>
						<?php echo 'Address: <b>'.ucfirst($ComplaintArrs['Complaint']['customer_address']).'</b>'; ?>
						
						</td>
						<td>
						<?php	echo '<span class="label label-danger">'.$ComplaintArrs['NappUser1']['name'].' '.$ComplaintArrs['NappUser1']['lname'].'</span>';
						?>						
						</td>				
						<td>
						<?php	echo '<span class="label label-danger">'.$ComplaintArrs['NappUser']['name'].' '.$ComplaintArrs['NappUser']['lname'].'</span>';
						?>						
						</td>
						<td><?php echo h($ComplaintArrs['Department']['department_title']); ?></td>								
						<td><?php echo h($ComplaintArrs['Complaint']['product_name']); ?></td>
						<td><?php echo h($ComplaintArrs['Complaint']['product_color']); ?></td>		
						<td><?php echo h($ComplaintArrs['ComplaintType']['title']); ?></td>							
						<td><?php echo h($ComplaintArrs['Complaint']['reason_for_complaint']); ?></td>							
						<td><?php echo h($ComplaintArrs['Complaint']['created']); ?></td>					
						<td>
							<a href="<?php echo SITEURL.'complaints/detail/'.base64_encode($ComplaintArrs['Complaint']['complaint_id']) ?>" class="btn btn-mini btn-danger">View </a>
							
							<?php if($ComplaintArrs['Complaint']['complaint_to'] != $emp_id){?>
								<a href="<?php echo SITEURL.'complaints/edit/'.base64_encode($ComplaintArrs['Complaint']['complaint_id']) ?>" class="btn btn-mini btn-success">Edit </a>
							<?php } ?>
							
							<?php if($ComplaintArrs['Conformance']){ ?>
								<a href="<?php echo SITEURL.'staffs/detail/'.base64_encode($ComplaintArrs['Conformance'][0]['nc_number']); ?>" class="btn btn-mini btn-warning ">NC Detail</a>
								
							<?php }  ?>
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