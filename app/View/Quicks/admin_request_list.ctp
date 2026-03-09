	<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class="active"><a href="<?php echo SITEURL; ?>admin/quicks/request_list">Contact Us Request List</a></li>
			
	</ul><!-- /.breadcrumb -->

</div>

<div class="page-content">
		<div class="page-header">
			<h1>Contact Us Request List &nbsp;&nbsp;
			
			
			<form style="float:right" action="" method="post">
				<!--select name="type" style="font-size:12px;">
					<option value="">Select Type</option>
					<option value="home" <?php if($type=='home'){ echo 'selected';}?>>Solar for Homes</option>
					<option value="business" <?php if($type=='business'){ echo 'selected';}?>>Solar for Business</option>
					<option value="other" <?php if($type=='other'){ echo 'selected';}?>>Quick Quotes</option>
				</select-->
				<input type="text" placeholder="Search by Unique Id" name="data[search]" value="<?php echo @$search_uniqueid; ?>">
				<input type="submit" style="margin-top:5px;" name="submit" class="btn btn-mini btn-primary" value="Search">
				<a style="margin-top:5px;" class="btn btn-mini btn-warning" href="<?php echo SITEURL?>admin/quicks/request_list/clear">Clear All</a>

			</form>	
				
			</h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('Name'); ?></th>
				<th><?php echo $this->Paginator->sort('unique id'); ?></th>
				<th><?php echo $this->Paginator->sort('Email'); ?></th>
				<th><?php echo $this->Paginator->sort('Phone'); ?></th>
				<th><?php echo $this->Paginator->sort('Address'); ?></th>
				<!--th><?php echo $this->Paginator->sort('Pin Code'); ?></th-->
				<th><?php echo $this->Paginator->sort('Note'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th><?php echo $this->Paginator->sort('Created'); ?></th>
				<th><?php echo $this->Paginator->sort('solortype','Type'); ?></th>
			
			
				 
			
				</tr>
				</thead>
				<tbody>
						<?php foreach ($QuoteRequest as $QuickQuotes): ?>
					<tr>
					<td><?php echo h($QuickQuotes['QuoteRequest']['fullname']); ?>&nbsp;</td>
					<td><a href="#solar_model_<?php echo  $QuickQuotes['QuoteRequest']['id']?>" data-toggle="modal"><?php echo h($QuickQuotes['QuoteRequest']['uniqueid']); ?></a>&nbsp;
					<div id="solar_model_<?php echo  $QuickQuotes['QuoteRequest']['id']?>" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Quotes Details</h4>
											</div>

								<div class="modal-body">
								<div class="row">
								<div class="col-xs-12">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="simple-table" >
										<thead>
										<tr>
											<th>Field</th>
											<th>Name</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td>Unique Number</td>
												<td>
												<?php if($QuickQuotes['QuoteRequest']['solortype']==0){?>
												<span class="label label-warning">Home</span>

												<?php }else if($QuickQuotes['QuoteRequest']['status']==1){?>
												<span class="label label-info">Business </span>



												<?php }else{ ?>
												<span class="label label-success">Quick Quote</span>
												<?php }?>&nbsp;
												</td>
											</tr>
											<tr>
												<td>Type</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['uniqueid']); ?></td>
											</tr>
											<tr>
												<td>Name</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['fullname']); ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['email']); ?></td>
											</tr>
											<tr>
												<td>Phone</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['phone']); ?></td>
											</tr>
											<tr>
												<td>Address</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['address']); ?></td>
											</tr>
											<!--tr>
												<td>Pincode</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['pincode']); ?></td>
											</tr-->
											<?php if($QuickQuotes['QuoteRequest']['more_check']==1) {?>
											<tr>
												<td>System Selection</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['system_selection']); ?>kW</td>
											</tr>
											<tr>
												<td>Help me decide</td>
												<td><?php if($QuickQuotes['QuoteRequest']['help_me_decide']==1) {echo 'Yes';}else{ echo 'No';}?></td>
											</tr>
											<tr>
												<td>Monthly Power Bill</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['monthly_power_bill']); ?></td>
											</tr>
											<tr>
												<td>Notes</td>
												<td><?php echo h($QuickQuotes['QuoteRequest']['note']); ?></td>
											</tr>
											<?php } ?>	
											<tr>
												<td>Posted On</td>
												<td> <?php echo date('d-M-Y',strtotime($QuickQuotes['QuoteRequest']['created'])); ?></td>
											</tr>											
											
										</tbody>
										
									</table>
								</div>
								</div>
								</div>
								</div>
							</div>
						</div>
					</div>
					
					</td>
					<td><?php echo h($QuickQuotes['QuoteRequest']['email']); ?>&nbsp;</td>
					<td><?php echo h($QuickQuotes['QuoteRequest']['phone']); ?>&nbsp;</td>
				
					<td><?php echo h($QuickQuotes['QuoteRequest']['address']); ?>&nbsp;</td>
					<!--td><?php echo h($QuickQuotes['QuoteRequest']['pincode']); ?>&nbsp;</td--->
					<td><?php echo h($QuickQuotes['QuoteRequest']['note']); ?>&nbsp;</td>
					 <td>
						<?php if($QuickQuotes['QuoteRequest']['status']==0){?>
							<span class="label label-warning">New Lead</span>
							
							<?php }else if($QuickQuotes['QuoteRequest']['status']==1){?>
							<span class="label label-info">Followed Up </span>
						
							
							
						<?php }else{ ?>
						<span class="label label-success">Complete</span>
						<?php }?>&nbsp;
						</td>
                    <td> <?php echo date('d-M-Y',strtotime($QuickQuotes['QuoteRequest']['created'])); ?></td>
					 <td>
						<?php if($QuickQuotes['QuoteRequest']['solortype']==0){?>
							<span class="label label-warning">Home</span>
							
							<?php }else if($QuickQuotes['QuoteRequest']['status']==1){?>
							<span class="label label-info">Business </span>
						
							
							
						<?php }else{ ?>
						<span class="label label-success">Quick Quote</span>
						<?php }?>&nbsp;
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