<div class="nodes form">
<?php echo $this->Form->create('Node', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Edit Node'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('mac');
		echo $this->Form->input('device');
		echo $this->Form->input('rsakeypub', array('label'=>'RSA Public Key'));
		echo $this->Form->input('ip', array('label'=>'Tinc IP'));
		echo $this->Form->input('bitmask');
		echo $this->Form->input('address', array('label'=>'IP Community Node'));
		echo $this->Form->input('port');
		echo $this->Form->input('isgetinconfserver', array('label'=>'Is GeTINConf-Server'));
	?>
	</fieldset>
      <div class="form-actions">
			<?php echo $this->Form->submit(__('Save'), array(
			            'div' => false,
			            'class' => 'btn',
			        )); ?>
			<?php echo $this->Html->link(__('Cancel'), array('controller' => 'networks', 'action' => 'view', $network_id), array('class'=>'btn'
					)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>

