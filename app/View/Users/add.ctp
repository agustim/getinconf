<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('username', array('class'=>'span4'));
        echo $this->Form->input('password', array('type'=>'password'));
        echo $this->Form->input('confirm_password', array('type'=>'password'));       
        echo $this->Form->input('role', array('type'=>'select',
                        'options'=>array('admin'=>'admin','author'=>'author')
                                ));
        echo $this->Form->input('email');
    ?>
    </fieldset>
<?php echo $this->Form->end(array('label'=>__('Submit'),'class'=>'btn btn-primar','div'=>array('class'=>'controls'))); ?>
</div>