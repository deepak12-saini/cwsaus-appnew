<link rel="stylesheet" href="<?php echo SITEURL; ?>theme/css/bootstrap.css" />
<link rel="stylesheet" href="<?php echo SITEURL; ?>theme/css/font-awesome.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<link rel="stylesheet" href="<?php echo SITEURL; ?>theme/css/ace-fonts.css" />
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo SITEURL; ?>theme/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
<style>
table {
    background-color: transparent;
    font-size: 12px;
}
</style>
<div class="page-content" style="height:402px;">
		<div class="page-header">
			<h1>Client Category
			<?php echo $this->Html->link('Add New',array('controller' => 'clients','action' => 'admin_clienttype_add'),array('class'=>'btn btn-info btn-xs top-button')); ?>		
			</h1>
		</div>	
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="simple-table" >
				<thead>
				<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name','Category Name'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
						<?php foreach ($ClientTypeArr as $ClientTypeArrs): ?>
					<tr>
					<td>#<?php echo h($ClientTypeArrs['ClientType']['id']); ?>&nbsp;</td>
					<td><?php echo $ClientTypeArrs['ClientType']['name']; ?>&nbsp;</td>
					
					<td>
						<?php echo $this->Html->link('Edit',array('controller' => 'clients','action' => 'admin_clienttype_edit/'.$ClientTypeArrs['ClientType']['id']),array('class'=>'btn btn-primary btn-xs top-button')); ?>
					</td>
					
					</tr>
					<?php endforeach; ?>

				</tbody>
			</table>			
			</div>
		</div>
	</div>		
	
</div>		
