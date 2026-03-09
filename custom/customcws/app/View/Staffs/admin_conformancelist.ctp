	
	<style>
		.btn{margin-bottom: 5px; }
		.label-danger, .label.label-danger, .badge.badge-danger, .badge-danger {
			margin-bottom: 5px;
		}
	</style>
	
	<div class="page-content">
	<div class="page-header">
		<h1>Non Conformance List
			
		</h1>
	</div>
	
	
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>				
					<th><?php echo $this->Paginator->sort('nc_number'); ?></th>							
					<th><?php echo $this->Paginator->sort('compaint_by'); ?></th>				
					<th><?php echo $this->Paginator->sort('compaint_to'); ?></th>
					<th><?php echo $this->Paginator->sort('non_conforance','Non Conformance'); ?></th>
					<th><?php echo $this->Paginator->sort('non_conforance_raised','Non Conformance Raised'); ?></th>							
					<th><?php echo $this->Paginator->sort('dept_id','Department'); ?></th>
					<th><?php echo $this->Paginator->sort('aspects_examined'); ?></th>		
					<th><?php echo $this->Paginator->sort('corrective_action_taken'); ?></th>								
					<th><?php echo $this->Paginator->sort('preventive_action'); ?></th>								
					<th><?php echo $this->Paginator->sort('management_representive','Management'); ?></th>								
											
								
					<th><?php echo $this->Paginator->sort('status'); ?></th>				
					<th><?php echo $this->Paginator->sort('created'); ?></th>				
					<th>Action</th>				
					
				</tr>
				</thead>
				<tbody>
				<?php 
				foreach ($ConformanceArr as $conformance): 

				
				?>
					<tr>
						<td><?php echo h($conformance['Conformance']['nc_number']); ?></td>						
						<td><?php echo '<span class="label label-info">'.$conformance['NappUser1']['name'].' '.$conformance['NappUser1']['lname'].'</span>'; ?></td>				
						<td>
						<?php
						foreach($conformance['ConformanceRelation'] as $napuser){
							if($napuser['NappUser']['id'] != $conformance['NappUser1']['id']){
								echo '<span class="label label-danger">'.$napuser['NappUser']['name'].' '.$napuser['NappUser']['lname'].'</span>';
							}
						}
						?>
						
						</td>		
						<td><?php echo h($conformance['Conformance']['non_conforance']); ?></td>
						<td><?php echo h($conformance['Conformance']['non_conforance_raised']); ?></td>		
						<td><?php echo h($conformance['Department']['department_title']); ?></td>							
						<td><?php echo h($conformance['Conformance']['aspects_examined']); ?></td>										
						<td>
						<?php echo h($conformance['Conformance']['corrective_action_taken']); ?>
						
						<?php if(!empty($conformance['Conformance']['is_corrective'])){ ?><br><br>
							<b>Posted By : <?php echo $conformance['Conformance']['is_corrective']; ?></b>
						<?php } ?>
						
						</td>										
						<td><?php echo h($conformance['Conformance']['preventive_action']); ?>
						
						
						
						<?php if(!empty($conformance['Conformance']['is_preventive'])){ ?><br><br>
							<b>Posted By : <?php echo $conformance['Conformance']['is_preventive']; ?></b>						
						<?php } ?>
						
						
						</td>										
														
						<td>
						<?php echo h($conformance['Conformance']['management_representive']); ?>
						
						<?php if(!empty($conformance['User']['name'])){ ?><br><br>
							<b style="color:red;"><?php echo $conformance['User']['name']; ?> (Management)</b>
						<?php } ?>
						
						</td>										
											
						<td>
							<?php if($conformance['Conformance']['status'] == 1){ echo '<span class="label label-danger"> Pending</span>'; } else if($conformance['Conformance']['status'] == 2){ echo '<span  class="label label-warning"> In-Process</span>'; }else if($conformance['Conformance']['status'] == 3){ echo '<span  class="label label-success"> Completed</span>'; } ?>
						</td>							
						<td><?php echo h($conformance['Conformance']['created']); ?></td>	
						
						<td>
							<a href="<?php echo SITEURL.'admin/staffs/detail/'.base64_encode($conformance['Conformance']['nc_number']).'/1'; ?>" class="btn btn-mini btn-danger ">View</a>
							<?php if($conformance['Conformance']['status'] < 3){?>
								<a href="<?php echo SITEURL.'admin/staffs/replyto/'.base64_encode($conformance['Conformance']['id']); ?>" class="btn btn-mini btn-primary to ">Reply</a>
							<?php }else{ echo 'N/A'; } ?>
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