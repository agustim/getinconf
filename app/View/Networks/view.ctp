<div class="networks view">
<h2><?php  echo h($network['Network']['name']);; ?></h2>
	<?php
			echo $this->Html->create(); 
			echo $this->Html->input( h($network['Network']['ip']), array('label'=>'IP'));
			echo $this->Html->input( h($network['Network']['netmask']), array('label'=>'Netmask'));
			echo $this->Html->input( h($network['Network']['bitmask']), array('label'=>'Bitmask'));
			echo $this->Html->input( h($network['Network']['internalkey']), array('label'=>'Interal Key'));
			echo $this->Html->input( h($network['Network']['automaticconnectto']), array('label'=>'Automatic ConnectTo', 'value'=>($network['Network']['automaticconnectto'])?__('Yes'):__('No')));
			echo $this->Html->input( h($network['Network']['trustednodes']), array('label'=>'Trusted Nodes', 'value'=>($network['Network']['trustednodes'])?__('Yes'):__('No')));
		?>
</div>
<div class="form-actions">
	<?php echo $this->Html->link(__('Edit Network'), array('action' => 'edit', $network['Network']['id']),array('class'=>'btn')); ?>
	<?php echo $this->Form->postLink(__('Delete Network'), array('action' => 'delete', $network['Network']['id']), array('class'=>'btn') , __('Are you sure you want to delete # %s?', $network['Network']['id'])); ?>
	<?php echo $this->Html->link(__('List Networks'), array('action' => 'index'), array('class'=>'btn'));  ?>
</div>
<div class="related">
	<h3><?php echo __('Nodes'); ?></h3>
	<?php if (!empty($network['Node'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Mac'); ?></th>
		<th><?php echo __('Device'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Bit'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('GW'); ?></th>
		<th><?php echo __('IPPublic'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($network['Node'] as $node): ?>
		<tr>
			<td><?php echo $node['name']; ?></td>
			<td><?php echo $node['mac']; ?></td>
			<td><?php echo $node['device']; ?></td>
			<td><?php echo $node['ip']; ?></td>
			<td><?php echo $node['bitmask']; ?></td>
			<td><?php echo $node['address']; ?></td>
			<td><?php echo ($node['is_gateway'])?__('Yes'):__('No'); ?></td>
			<td><?php echo ($node['public_ip'])?__('Yes'):__('No'); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'nodes', 'action' => 'view', $node['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'nodes', 'action' => 'edit', $node['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'nodes', 'action' => 'delete', $node['id']), null, __('Are you sure you want to delete # %s?', $node['id'])); ?>
				<?php echo $this->Html->link(__('Config'), array('controller' => 'nodes', 'action' => 'configure', $node['id'], 1, 0)); ?>
				<?php if(!$network['Network']['automaticconnectto']) echo $this->Html->link(__('ConnectTo'), array('controller' => 'connects', 'action' => 'connectto', $node['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<div class="form-actions">
	<?php echo $this->Html->link(__('New Node'), array('controller' => 'nodes', 'action' => 'add' , $network['Network']['id']), array('class'=>'btn')); ?>
</div>
</div>
