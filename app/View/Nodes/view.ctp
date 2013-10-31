<div class="nodes view">
<h2><?php  echo __('Node'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($node['Node']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($node['Node']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mac'); ?></dt>
		<dd>
			<?php echo h($node['Node']['mac']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device'); ?></dt>
		<dd>
			<?php echo h($node['Node']['device']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rsakeypub'); ?></dt>
		<dd>
			<?php echo h($node['Node']['rsakeypub']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip'); ?></dt>
		<dd>
			<?php echo h($node['Node']['ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bitmask'); ?></dt>
		<dd>
			<?php echo h($node['Node']['bitmask']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($node['Node']['address']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Is Gateway?'); ?></dt>
                <dd>
                        <?php echo ($node['Node']['is_gateway'])?__('Yes'):__('No'); ?>
                        &nbsp;
                </dd>
                <dt><?php echo __('Public IP?'); ?></dt>
                <dd>
                        <?php echo ($node['Node']['public_ip'])?__('Yes'):__('No'); ?>
                        &nbsp;
                </dd>
		<dt><?php echo __('Network'); ?></dt>
		<dd>
			<?php echo $this->Html->link($node['Network']['name'], array('controller' => 'networks', 'action' => 'view', $node['Network']['id'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Hash_MAC'); ?></dt>
                <dd>
                        <?php echo h($node['Node']['hash_mac']); ?>
                        &nbsp;
                </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Node'), array('action' => 'edit', $node['Node']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Node'), array('action' => 'delete', $node['Node']['id']), null, __('Are you sure you want to delete # %s?', $node['Node']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Back to Network'), array('controller' => 'networks', 'action' => 'view', $node['Network']['id'])); ?> </li>
	</ul>
</div>
