<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<?php
			echo $this->Html->create(); 
			echo $this->Html->input( h($user['User']['id']), array('label'=>'Id'));
			echo $this->Html->input( h($user['User']['username']), array('label'=>'Username'));
			echo $this->Html->input( h($user['User']['role']), array('label'=>'Role'));
			echo $this->Html->input( h($user['User']['email']), array('label'=>'EMail'));
			echo $this->Html->input( h($user['User']['created']), array('label'=>'Created'));
			echo $this->Html->input( h($user['User']['modified']), array('label'=>'Modified'));
		?>
<div class="form-actions">

			<?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn')); ?>
			<?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn') , __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('List Users'), array('action' => 'index'), array('class'=>'btn')); ?>

</div>
<?php echo $this->Html->end(); ?>
</div>