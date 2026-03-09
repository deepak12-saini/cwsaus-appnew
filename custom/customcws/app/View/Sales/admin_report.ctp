	<div class="page-content">
		<div class="page-header">
			<h1>
			Duro Sales Report >> <small><?php echo $napuser['NappUser']['name'].' '.$napuser['NappUser']['lname']; ?>
			
			<form action="" method="post" style="float:right;">
				<select name="slaetype">
					<option value="">Show All</option>
					<?php foreach($slatestype as $slatestypes){ ?>
						<option <?php if($slaetype ==  $slatestypes['SaleQuestion']['id']){ echo 'selected'; }?> value="<?php echo $slatestypes['SaleQuestion']['id']; ?>"><?php echo $slatestypes['SaleQuestion']['title']; ?></option>
					<?php } ?>
				</select>
				<input type="text" name="startdate" value="<?php echo $startdate; ?>" class="datepicker" placeholder="Start Date" >
				<input type="text" name="enddate" value="<?php echo $enddate; ?>" class="datepicker1" placeholder="End Date" >
				<input type="submit" name="search" value="search" class="btn btn-info btn-xs" >	
				<a href="<?php echo SITEURL.'admin/sales/report/'.$napuser['NappUser']['id'].'/clearall' ?>" class="btn btn-warning btn-xs">Show All</a>
				
				<a href="<?php echo SITEURL.'admin/sales' ?>" class="btn btn-nverse btn-xs">Back</a>
			</form>		
			
			</h1>
			<br><h1>
			<?php
			$totalsale = array();
			foreach ($SaleRepArr as $SaleRepArrs){
				if(!empty($SaleRepArrs['SaleQuestion']['id'])){
					$totalsale[$SaleRepArrs['SaleQuestion']['id']][] = $SaleRepArrs['SaleRep']['name'];
				}
			}
						
			$color = array('warning','success','info','danger','info','primary','inverse');
			$i=0; 
			foreach($slatestype as $slatestypes){ ?>
				<span class="label label-<?php echo $color[$i]; ?>">
				<?php echo $slatestypes['SaleQuestion']['title']; ?> (<?php  if(!empty($totalsale[$slatestypes['SaleQuestion']['id']])){ echo count($totalsale[$slatestypes['SaleQuestion']['id']]); }else{  echo '0'; }  ?>)</span>
			<?php  $i++; }  ?></h1>
		</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('Contact Type'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('phone'); ?></th>
				<th><?php echo $this->Paginator->sort('company'); ?></th>
				<th><?php echo $this->Paginator->sort('spoken_to'); ?></th>
				<th><?php echo $this->Paginator->sort('sample_given_request'); ?></th>
				<th><?php echo $this->Paginator->sort('comment'); ?></th>				
				<th><?php echo $this->Paginator->sort('address'); ?></th>				
				<th><?php echo $this->Paginator->sort('created'); ?></th>				
               

				
				</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach ($SaleRepArr as $SaleRepArrs): ?>
					<tr>
					<td>#<?php echo $i; ?>&nbsp;</td>
					<td>
					<?php 
					if($SaleRepArrs['SaleQuestion']['id'] == 1){
						echo '<span class="label label-warning">'.$SaleRepArrs['SaleQuestion']['title'].'</span>';
					}else if($SaleRepArrs['SaleQuestion']['id'] == 2){
							echo '<span class="label label-success">'.$SaleRepArrs['SaleQuestion']['title'].'</span>';
					}else if($SaleRepArrs['SaleQuestion']['id'] == 3){
						echo '<span class="label label-info">'.$SaleRepArrs['SaleQuestion']['title'].'</span>';
					}else{
						echo '<span class="label label-danger">'.$SaleRepArrs['SaleQuestion']['title'].'</span>';
					}
					
					?>
					
					
					</td>
					<td><?php echo $SaleRepArrs['SaleRep']['name']; ?>&nbsp;</td>
					<td><?php echo h($SaleRepArrs['SaleRep']['email']); ?>&nbsp;</td>
					<td><?php echo h($SaleRepArrs['SaleRep']['phone']); ?>&nbsp;</td>
					<td><?php echo h($SaleRepArrs['SaleRep']['company']); ?>&nbsp;</td>					
					<td><?php echo h($SaleRepArrs['SaleRep']['spoken_to']); ?>&nbsp;</td>					
					<td><?php echo h($SaleRepArrs['SaleRep']['sample_given_request']); ?>&nbsp;</td>					
					<td><?php echo h($SaleRepArrs['SaleRep']['comment']); ?>&nbsp;</td>					
					<td><?php echo h($SaleRepArrs['SaleRep']['address']); ?>&nbsp;</td>					
					<td><?php echo date('d M Y h:i a',strtotime($SaleRepArrs['SaleRep']['created'])); ?>&nbsp;</td>					
					
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
<script>
jQuery(function(){ 
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',			
	});$('.datepicker1').datepicker({
		format: 'yyyy-mm-dd',			
	});
});


</script>