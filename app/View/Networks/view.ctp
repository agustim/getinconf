<div class="networks view">
<h2><?php  echo h($network['Network']['name']); ?></h2>
	<?php
			echo $this->Html->create(); 
			echo $this->Html->input( h($network['Network']['ip']), array('label'=>'IP'));
			echo $this->Html->input( h($network['Network']['netmask']), array('label'=>'Netmask'));
			echo $this->Html->input( h($network['Network']['bitmask']), array('label'=>'Bitmask'));
			echo $this->Html->input( h($network['Network']['internalkey']), array('label'=>'Interal Key'));
			echo $this->Html->input( h($network['Network']['trustednodes']), 
				array('label'=>'Trusted Nodes', 'type' => 'checkbox'));
			echo $this->Html->input( h($network['Network']['mode']), array('label'=>'Mode'));
			echo $this->Html->input( ($network['Network']['typeip'] == '1')?'IPv4':'IPv6', array('label'=>'Type IP'))
		?>
</div>
<div class="form-actions">
	<?php echo $this->Html->link("<i class='icon-pencil'></i> ".__('Edit Network'), 
			array('action' => 'edit', $network['Network']['id']),
			array('class'=>'btn','title'=>__('Edit Network'),'escape' => false)); ?>
	<?php echo $this->Form->postLink("<i class='icon-trash'></i> ".__('Delete Network'), 
			array('action' => 'delete', $network['Network']['id']), 
			array('class'=>'btn','title'=>__('Delete Network'),'escape' => false) , __('Are you sure you want to delete # %s?', $network['Network']['id'])); ?>
	<?php echo $this->Html->link("<i class='icon-list'></i> ".__('List Networks'), 
			array('action' => 'index'), 
			array('class'=>'btn','title'=>__('List Networks'),'escape' => false));  ?>
</div>
<div class="related">
	<h3><?php echo __('Nodes'); ?></h3>
	<?php if (!empty($network['Node'])): ?>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Mac'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($network['Node'] as $node): ?>
		<tr>
			<td><?php echo $node['name']; ?></td>
			<td><?php echo $node['mac']; ?></td>
			<td><?php echo $node['ip']; ?>/<?php echo $node['bitmask']; ?></td>
			<td><?php echo $node['address']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link("<i class='icon-eye-open'></i>", 
				array('controller' => 'nodes', 'action' => 'view', $node['id']),
				array('class'=>'btn','title'=> __('View'),'escape' => false)); ?>
				<?php echo $this->Html->link("<i class='icon-pencil'></i>", 
					array('controller' => 'nodes', 'action' => 'edit', $node['id']),
					array('class'=>'btn','title'=> __('Edit'),'escape' => false)); ?>
				<?php echo $this->Form->postLink("<i class='icon-trash'></i>", 
					array('controller' => 'nodes', 'action' => 'delete', $node['id']), 
					array('class'=>'btn','title'=> __('Delete'),'escape' => false)
					, __('Are you sure you want to delete # %s?', $node['id'])); ?>
				<?php echo $this->Html->link("<i class='icon-file'></i>", 
					array('controller' => 'nodes', 'action' => 'configure', $node['id'], 1, 0),
				array('class'=>'btn','title'=> __('Config'),'escape' => false)); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<div class="form-actions">
	<?php echo $this->Html->link("<i class='icon-edit'></i> ". __('New Node'), array('controller' => 'nodes', 'action' => 'add' , $network['Network']['id']), array('class'=>'btn','title'=> __('New Node'),'escape' => false)); ?>
</div>
</div>
