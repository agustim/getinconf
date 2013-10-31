<div id="Connect">
<?php

	echo $this->Form->create('Connect',array('url' => array ('action'=>'connectto', $node_id))); 

	foreach($nodes as $n_id => $n_name)
		echo $this->Form->input($varname.$n_id,array('type'=>'checkbox','label'=>$n_name));
	
	echo $this->Form->end('Submit');
?>
</div>
