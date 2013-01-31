<div class="users form">
	<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('class'=>'span4'));
		echo $this->Form->input('password', array('type'=>'password'));
    echo $this->Form->input('confirm_password', array('type'=>'password'));  
		echo $this->Form->input('role', array('type'=>'select',
						'options'=>array('admin'=>'admin','author'=>'author')
								));
		echo $this->Form->input('email');
	?>
      <div class="form-actions">
        <?php echo $this->Form->submit(__('Save changes'), array(
            'div' => false,
            'class' => 'btn btn-primary',
        )); ?>
        <?php echo $this->Html->link(__('Cancel'),array('action'=>'index'), array('class'=>'btn')) ?>
    </div>
	</fieldset>
<div class='control-group'>
<?php echo $this->Form->end(); ?>
</div>
</div>

