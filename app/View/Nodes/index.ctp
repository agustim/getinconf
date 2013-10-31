<div class="nodes index">
	<h2><?php echo __('Nodes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('mac'); ?></th>
			<th><?php echo $this->Paginator->sort('ip'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('network_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($nodes as $node): ?>
	<tr>
		<td><?php echo h($node['Node']['id']); ?>&nbsp;</td>
		<td><?php echo h($node['Node']['name']); ?>&nbsp;</td>
		<td><?php echo h($node['Node']['mac']); ?>&nbsp;</td>
		<td><?php echo h($node['Node']['ip']); ?>&nbsp;</td>
		<td><?php echo h($node['Node']['address']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($node['Network']['name'], array('controller' => 'networks', 'action' => 'view', $node['Network']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $node['Node']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $node['Node']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $node['Node']['id']), null, __('Are you sure you want to delete # %s?', $node['Node']['id'])); ?>
			<?php echo $this->Html->link(__('Config'), array('action' => 'configure', $node['Node']['id'])); ?>
			<?php echo $this->Html->link(__('ConnectTo'), array('controller' => 'connects', 'action' => 'connectto', $node['Node']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Node'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Networks'), array('controller' => 'networks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Network'), array('controller' => 'networks', 'action' => 'add')); ?> </li>
	</ul>
</div>
