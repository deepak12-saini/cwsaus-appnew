	
<style>
.btn{margin-bottom: 5px; }
.label {
    margin-bottom: 5px;
}
</style>
	
	<div class="page-content">

		<div class="page-header">
			<h1>Redeemed Coupon </h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				
				<th><?php echo $this->Paginator->sort('id'); ?></th>				
				<th><?php echo $this->Paginator->sort('couponcode'); ?></th>					
				<th><?php echo $this->Paginator->sort('amount'); ?></th>					
				<!--th><?php echo $this->Paginator->sort('name','Name'); ?></th-->					
				<th><?php echo $this->Paginator->sort('phone'); ?></th>				
				<th><?php echo $this->Paginator->sort('is_redeem'); ?></th>				
				<th><?php echo $this->Paginator->sort('redeem_date','Redeemed Date'); ?></th>				
				<th><?php echo $this->Paginator->sort('created','Date'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach ($CouponArr as $CouponArrs): ?>
					<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo h($CouponArrs['Coupon']['couponcode']); ?>&nbsp;</td>
					<td><?php echo h($CouponArrs['Coupon']['amount']); ?> ₹&nbsp;</td>
					<!--td><?php echo ucfirst($CouponArrs['NappUser']['name']); ?>&nbsp;<?php echo ucfirst($CouponArrs['NappUser']['lname']); ?></td-->		
					<td><?php echo h($CouponArrs['Coupon']['phone']); ?>						
					</td>								
					<td>
						<?php if($CouponArrs['Coupon']['is_redeem'] == 1){ ?>
							<span class="label label-danger">Not Redeem</span>
						<?php }else if($CouponArrs['Coupon']['is_redeem'] == 2){ ?>
							<span class="label label-success">Redeemed</span>
						<?php  } ?>
					</td>
					  <td><?php 
					  if($CouponArrs['Coupon']['is_redeem'] == 2){
						echo date('d M Y h:i a',strtotime($CouponArrs['Coupon']['redeem_date']));
					  }else{
						echo 'Pending';
					  } 
					  ?></td>
                    <td><?php echo date('d M Y h:i a',strtotime($CouponArrs['Coupon']['created'])); ?></td>
                  
                    <td>					
						<?php if($CouponArrs['Coupon']['is_redeem'] == 1){ ?>
							<a class="btn btn-xs btn-info" href="<?php echo SITEURL.'admin/users/redeem/'.$CouponArrs['Coupon']['couponcode'] ?>">Redeem Now</a>
						<?php }else { 'N/A'; } ?>
						
					</td>					
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