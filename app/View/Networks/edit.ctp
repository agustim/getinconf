<div class="networks form">
<?php echo $this->Form->create('Network', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Edit Network'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('ip');
		echo $this->Form->input('netmask');
		echo $this->Form->input('bitmask');
		echo $this->Form->input('internalkey',array('label'=>'Internal Key'));
		echo $this->Form->input('trustednodes',array('label'=>'Trusted Nodes'));
		echo $this->Form->input('mode',array('type'=>'select','label'=>'Mode', 'options'=>array('router'=>'router','switch'=>'switch','hub'=>'hub')));
		echo $this->Form->input('typeip', array('type'=>'select','label'=>'IP Type', 'options'=>array(1=>'IPv4', 2=>'IPv6')));
	?>
	    <div class="form-actions">
        <?php echo $this->Form->submit(__('Save'), array(
            'div' => false,
            'class' => 'btn',
        )); ?>
        <?php echo $this->Html->link(__('Cancel'),array('action'=>'index'), array('class'=>'btn')) ?>
        </div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
