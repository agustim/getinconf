<div class="networks form">
<?php echo $this->Form->create('Network', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Add Network'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('ip');
		echo $this->Form->input('netmask');
		echo $this->Form->input('bitmask');
                echo $this->Form->input('internalkey',array('label'=>'Internal Key'));
                echo $this->Form->input('automaticconnectto',array('label'=>'Automatic ConnectTo'));
                echo $this->Form->input('trustednodes',array('label'=>'Trusted Nodes'));
	?>
      <div class="form-actions">
			<?php echo $this->Form->submit(__('Save'), array(
			            'div' => false,
			            'class' => 'btn',
			        )); ?>
			<?php echo $this->Html->link(__('Cancel'), array(
						'action' => 'index'), array('class'=>'btn'
					)); ?>
		</div>
	</fieldset>
	<div class='control-group'>
		<?php echo $this->Form->end(); ?>
	</div>
</div>