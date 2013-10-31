<div class="networks form">
<?php echo $this->Form->create('Network'); ?>
	<fieldset>
		<legend><?php echo __('Edit Network'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('ip');
		echo $this->Form->input('netmask');
		echo $this->Form->input('bitmask');
		echo $this->Form->input('internalkey',array('label'=>'Internal Key'));
		echo $this->Form->input('automaticconnectto',array('label'=>'Automatic ConnectTo'));
		echo $this->Form->input('trustednodes',array('label'=>'Trusted Nodes'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Network.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Network.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Networks'), array('action' => 'index')); ?></li>
	</ul>
</div>
