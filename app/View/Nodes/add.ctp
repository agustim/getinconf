<div class="nodes form">
<?php echo $this->Form->create('Node'); ?>
	<fieldset>
		<legend><?php echo __('Add Node'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('mac');
		echo $this->Form->input('device');
		echo $this->Form->input('rsakeypub');
		echo $this->Form->input('ip');
		echo $this->Form->input('bitmask');
		echo $this->Form->input('address');
		echo $this->Form->input('is_gateway');
		echo $this->Form->input('public_ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Back to Network'), array('controller' => 'networks', 'action' => 'view', $network_id)); ?></li>
	</ul>
</div>
