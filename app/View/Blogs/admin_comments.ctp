<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="<?php echo SITEURL ?>admin/users/dashboard">Home</a>
		</li>
			<li class="active"><a href="<?php echo SITEURL; ?>admin/blogs">Blogs</a></li>
			<li class=""><a href="#">Blog Comments</a></li>
	</ul><!-- /.breadcrumb -->

</div>

<div class="page-content">
		<div class="page-header">
			<h1>Blog Comments
			
			<div class="pull-right"><a style="margin-top:5px;margin-left:5px;" class="btn btn-mini btn-inverse" href="#" onclick="window.history.back();">Back</a></div>
			<form style="float:right" action="" method="post">
				<input type="text" placeholder="Search by name" name="data[search]" value="<?php echo @$search_comment; ?>">
				<input type="submit" style="margin-top:5px;" name="submit" class="btn btn-mini btn-primary" value="Search">
				<a style="margin-top:5px;" class="btn btn-mini btn-warning" href="<?php echo SITEURL?>admin/blogs/comments/clear">Clear All</a>

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
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('user_type'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('comment'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				 <th><?php echo $this->Paginator->sort('created'); ?></th>
                  

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($BlogComments as $BlogComment): ?>
					<tr>
					<td><?php echo h($BlogComment['BlogComment']['id']); ?>&nbsp;</td>
					<td><?php if($BlogComment['BlogComment']['user_type']==1){ echo 'Advisor';}else if($BlogComment['BlogComment']['user_type']==2){ echo 'Client';}else{ echo 'Guest User'; } ; ?>&nbsp;</td>
					<td><?php echo h($BlogComment['BlogComment']['name']); ?>&nbsp;</td>
					<td><?php echo h($BlogComment['BlogComment']['email']); ?>&nbsp;</td>
					<td><?php echo h($BlogComment['BlogComment']['comment']); ?>&nbsp;</td>
					
					<td><?php if($BlogComment['BlogComment']['status']==0){ ?>
						<a style="margin-left:25px" href="<?php echo SITEURL; ?>admin/blogs/mark_active/<?php echo $BlogComment['BlogComment']['blog_id'].'/'.$BlogComment['BlogComment']['id']; ?>"><img src="<?php echo SITEURL;?>img/lamp-inactive-icon.png"></a>
						
					<?php }else{?>
					<a style="margin-left:25px" href="<?php echo SITEURL; ?>admin/blogs/mark_inactive/<?php echo $BlogComment['BlogComment']['blog_id'].'/'.$BlogComment['BlogComment']['id']; ?>"><img src="<?php echo SITEURL;?>img/lamp-active-icon.png"></a>
					<?php 
					} ?>&nbsp;
					</td>		
                    <td> <?php echo date('d-M-Y',strtotime($BlogComment['BlogComment']['created'])); ?></td>
					<td class="actions">
												
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_comment', $BlogComment['BlogComment']['id'],$BlogComment['Blog']['id']), array('class'=>'btn btn-mini btn-danger'), __('Are you sure to delete?', $BlogComment['BlogComment']['id'])); ?>
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