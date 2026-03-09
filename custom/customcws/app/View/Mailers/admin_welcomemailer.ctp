<style>
	select {
		padding: 0px 4px;
		height: 29px;
		width: 205px;
		font-size: 14px;
	}
	.label {			
		margin-top: 5px;
	}
</style>
<div class="page-content">
		<div class="page-header">
			<h1>Welcome Email Logs <?php echo $this->Html->link('Send Mail',array('controller' => 'mailers','action' => 'sendwelcome'),array('class'=>'btn btn-info btn-xs top-button')); ?>
			
			<?php if(!empty($client_id)){?>
				<span class="label label-danger">Total Sent: <?php echo $totalsent; ?></span>
			<?php }else{ ?>
				<span class="label label-danger">Total Sent: <?php echo $totalsent; ?></span>
			<?php } ?>
			<form action="" method="post" style="float:right;">
				
				<select name="data[client_id]" style="width:160px;">
					<option value="">Select Employee </option>
					<?php foreach($NappUser as $cusers){ ?>
						<option <?php if($client_id == $cusers['NappUser']['id']){  echo 'selected'; } ?>  value="<?php echo $cusers['NappUser']['id']; ?>"><?php echo $cusers['NappUser']['name'].' '.$cusers['NappUser']['lname']; ?></option>
					<?php  } ?>
				</select>	
				<input type="search" class="datepicker" name="search" placeholder="Search By Date" value="<?php echo $date; ?>" style="width:220px">	
				<input type="submit"  class="btn btn-xs btn-primary" value="Search">
				
				<a class="btn btn-xs btn-warning" href="<?php echo SITEURL.'admin/mailers/index/clear'; ?>" >Clear All</a>
			</form>
			
			
			</h1>
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
					<th><?php echo $this->Paginator->sort('Sender Name'); ?></th>
					<th><?php echo $this->Paginator->sort('senderemail'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php 
					
					$i=1;
					foreach ($mailers as $welmailer): ?>
					<tr>
						<td>#<?php echo $i; ?>&nbsp;</td>
						<td><?php echo h($welmailer['WelcomeMailer']['name']); ?>&nbsp;</td>
						<td><?php echo h($welmailer['WelcomeMailer']['email']); ?>&nbsp;</td>				
						<td><?php echo h($welmailer['WelcomeMailer']['subject']); ?>&nbsp;</td>				
						<td>
						<?php 
							if($welmailer['WelcomeMailer']['user_id'] > 0){ 
								echo ucfirst($welmailer['NappUser']['name']).' '.ucfirst($welmailer['NappUser']['lname']); 
							}else{
								echo  'Admin'; 
							} 
						?>
						&nbsp;</td>				
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