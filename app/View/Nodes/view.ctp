<div class="nodes view">
<h2><?php echo h($node['Node']['name']); ?></h2>
	<?php
			echo $this->Html->create(); 
			echo $this->Html->input( h($node['Node']['mac']), array('label'=>'MAC'));
			echo $this->Html->input( h($node['Node']['device']), array('label'=>'Device'));
			echo $this->Html->input( h($node['Node']['rsakeypub']), array('label'=>'RSA Public Key', 'type' => 'textarea'));
			echo $this->Html->input( h($node['Node']['ip']), array('label'=>'Tinc IP'));
			echo $this->Html->input( h($node['Node']['bitmask']), array('label'=>'Bitmask'));
			echo $this->Html->input( h($node['Node']['address']), array('label'=>'IP Community Node'));
			echo $this->Html->input( h($node['Node']['port']), array('label'=>'Port'));
			echo $this->Html->input(
				$this->Html->link($node['Network']['name'], array('controller' => 'networks', 'action' => 'view', $node['Network']['id'])), 
				array('label'=>'Network', 'type' => 'link')); 
			echo $this->Html->input( h($node['Node']['hash_mac']), array('label'=>'MAC Hash (Internal)'));

?>
</div>
<div class="form-actions">
	<?php echo $this->Html->link("<i class='icon-pencil'></i> ".__('Edit Node'), 
			array('action' => 'edit', $node['Node']['id']),
			array('class'=>'btn','title'=>__('Edit Node'),'escape' => false)); ?>
	<?php echo $this->Form->postLink("<i class='icon-trash'></i> ".__('Delete Node'), 
			array('action' => 'delete', $node['Node']['id']), 
			array('class'=>'btn','title'=>__('Delete Node'),'escape' => false) , __('Are you sure you want to delete # %s?', $node['Node']['id'])); ?>
	<?php echo $this->Html->link("<i class='icon-list'></i> ".__('List Nodes from Network'), 
			array('controller'=>'networks','action' => 'view',$node['Network']['id']), 
			array('class'=>'btn','title'=>__('List Nodes from Network'),'escape' => false));  ?>
</div>

