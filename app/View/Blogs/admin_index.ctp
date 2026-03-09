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
			
	</ul><!-- /.breadcrumb -->

</div>

<div class="page-content">
		<div class="page-header">
			<h1>Blogs &nbsp;&nbsp; <?php echo $this->Html->link('Add',array('controller' => 'blogs','action' => 'admin_add'),array('class'=>'btn btn-info btn-small top-button')); ?>
			
			
			<form style="float:right" action="" method="post">
				<input type="text" placeholder="Search by title" name="data[search]" value="<?php echo @$search_article; ?>">
				<input type="submit" style="margin-top:5px;" name="submit" class="btn btn-mini btn-primary" value="Search">
				<a style="margin-top:5px;" class="btn btn-mini btn-warning" href="<?php echo SITEURL?>admin/blogs/index/clear">Clear All</a>

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
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('category','category'); ?></th>
				<th><?php echo $this->Paginator->sort('title_image'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				 <th><?php echo $this->Paginator->sort('created'); ?></th>
                  

				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($Blogs as $blog): ?>
					<tr>
					<td><?php echo h($blog['Blog']['id']); ?>&nbsp;</td>
					<td><?php echo h($blog['Category']['name']); ?>&nbsp;</td>
					<td><?php echo h($blog['Blog']['title']); ?>&nbsp;</td>
					<td><?php if($blog['Blog']['title_image']!=''){?><img src="<?php echo SITEURL.'blog_img/'.$blog['Blog']['title_image']; ?>" width="100" /><?php }?></td>
					 <td>
						<?php if($blog['Blog']['status']==1){?>
							<span class="label label-success">Active</span>
						<?php }else{ ?>
						<span class="label label-danger">In Active</span>
						<?php }?>&nbsp;
						</td>
                    <td> <?php echo date('d-M-Y',strtotime($blog['Blog']['created'])); ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id']),array('class'=>'btn btn-mini btn-info')); ?>
						
						<a href="#" target="_blank" class="btn btn-mini btn-warning">View</a>
						<!-- <a href="<?php echo SITEURL; ?>view/<?php echo $blog['Blog']['slug']; ?>" target="_blank" class="btn btn-mini btn-warning">view</a> <a href="<?php echo SITEURL?>admin/blogs/comments/<?php echo $blog['Blog']['id'];?>" class="btn btn-mini btn-purple">Comments(<?php echo count($blog['BlogComment'])?>)</a>			-->			
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blog['Blog']['id']), array('class'=>'btn btn-mini btn-danger'), __('Are you sure to delete?', $blog['Blog']['id'])); ?>
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