<div class="page-content">
		<div class="page-header">
			<h1>Welcome Email Logs <?php echo $this->Html->link('Send Mail',array('controller' => 'mailers','action' => 'sendwelcome'),array('class'=>'btn btn-info btn-xs top-button')); ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name','Receiver Name'); ?></th>
					<th><?php echo $this->Paginator->sort('email','Receiver Email'); ?></th>
					<th><?php echo $this->Paginator->sort('subject'); ?></th>
					<th><?php echo $this->Paginator->sort('senderemail'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php 
					
					$i=1;
					foreach ($welmailers as $welmailer): ?>
					<tr>
						<td>#<?php echo $i; ?>&nbsp;</td>
						<td><?php echo h($welmailer['WelcomeMailer']['name']); ?>&nbsp;</td>
						<td><?php echo h($welmailer['WelcomeMailer']['email']); ?>&nbsp;</td>				
						<td><?php echo h($welmailer['WelcomeMailer']['subject']); ?>&nbsp;</td>				
						<td><?php echo h($welmailer['WelcomeMailer']['senderemail']); ?>&nbsp;</td>				
						<td><?php if($welmailer['WelcomeMailer']['status'] == 1){ echo '<span class="label label-success">Sent</span>'; }else{ echo '<span class="label label-danger">Opened</span>'; } ?>&nbsp;</td>				
						<td> <?php echo date('d-M-Y h:i a',strtotime($welmailer['WelcomeMailer']['created'])); ?></td>					
					</tr>
					<?php $i++; endforeach; ?>

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