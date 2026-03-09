	
	<style>
		.btn{margin-bottom: 5px; }
		.label-danger, .label.label-danger, .badge.badge-danger, .badge-danger {
			margin-bottom: 5px;
		}
	</style>
	
	<div class="page-content">
	<div class="page-header">
		<h1>Non Conformance Detail
			<?php if($type==1){?>
				<a href="<?php echo SITEURL.'staffs/conformancelist'?>" class="btn btn-mini btn-info" style="float:right;">Back</a>
			<?php }else{ ?>
				<a href="<?php echo SITEURL.'complaints'?>" class="btn btn-mini btn-info" style="float:right;">Back</a>
			<?php }?>
		</h1>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<tbody>
				<tr><th>Non Conformance Number: </th><td><span class="label label-inverse"><?php echo h($ComplaintArr['Conformance']['nc_number']); ?></span></td></tr>	
				
				<tr><th>Compaint By</th><td><?php echo '<span class="label label-info">'.$ComplaintArr['NappUser1']['name'].' '.$ComplaintArr['NappUser1']['lname'].'</span>'; ?></td><tr>					
				<tr><th>Compaint To</th><td>
						<?php
						foreach($ComplaintArr['ConformanceRelation'] as $napuser){
							if($napuser['NappUser']['id'] != $ComplaintArr['NappUser1']['id']){
								echo '<span class="label label-danger">'.$napuser['NappUser']['name'].' '.$napuser['NappUser']['lname'].'</span>';
							}
						}?></td></tr>
						
				<tr><th>Non Conformance</th><td><?php echo h($ComplaintArr['Conformance']['non_conforance']); ?></td><tr>					
				<tr><th>Non Conformance Raised</th><td><?php echo h($ComplaintArr['Conformance']['non_conforance_raised']); ?></td><tr>						
										
				<tr><th>Department</th><td><?php echo h($ComplaintArr['Department']['department_title']); ?></td><tr>				
				<tr><th>Aspects Examined</th><td><?php echo h($ComplaintArr['Conformance']['aspects_examined']); ?></td><tr>					
				<tr><th>Corrective Action Taken</th><td><?php echo h($ComplaintArr['Conformance']['corrective_action_taken']); ?></td><tr>					
				<tr>
					<th>Corrective Action Taken</th>
					<td>
					<?php echo h($ComplaintArr['Conformance']['corrective_action_taken']); ?>
						
					<?php if(!empty($ComplaintArr['Conformance']['is_corrective'])){ ?><br><br>
						<b>Posted By : <?php echo $ComplaintArr['Conformance']['is_corrective']; ?></b>
					<?php } ?>
					</td>
				</tr>					
				<tr><th>
				Preventive Action</th><td><?php echo h($ComplaintArr['Conformance']['preventive_action']); ?>
				<?php if(!empty($ComplaintArr['Conformance']['is_preventive'])){ ?><br><br>
					<b>Posted By : <?php echo $ComplaintArr['Conformance']['is_preventive']; ?></b>
				<?php } ?>
				</td></tr>
				
				<tr><th>Management</th><td><?php echo $ComplaintArr['Conformance']['management_representive']; ?>
						<?php if(!empty($ComplaintArr['User']['name'])){ ?><br><br>
							<b style="color:red;"><?php echo $ComplaintArr['User']['name']; ?> (Management)</b>
						<?php } ?></b>
					
				</td></tr>
				<tr><th>Status</th>
				<td>
					<?php if($ComplaintArr['Conformance']['status'] == 1){ echo '<span class="label label-danger"> Pending</span>'; } else if($ComplaintArr['Conformance']['status'] == 2){ echo '<span  class="label label-warning"> In-Process</span>'; }else if($ComplaintArr['Conformance']['status'] == 3){ echo '<span  class="label label-success"> Completed</span>'; } ?>
				</td>
				</tr>
				<tr><th>Created</th>
				<td>
					<?php echo h($ComplaintArr['Conformance']['created']); ?>
				</td>
				</tr>
				</tbody>
				
			</table>			
			</div>
		</div>
	</div>		

	
</div>		