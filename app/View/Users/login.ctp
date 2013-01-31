	<div class="hero-unit">
			<div class="users form">
			<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
			    <fieldset>
			      <legend><?php echo __('Please enter your username and password'); ?></legend>
			    	<?php echo $this->Form->input('username'); ?>
        		<?php echo $this->Form->input('password'); ?>
        		<div class="control-group">
        			<div class="controls">
		            <?php echo $this->Form->submit('Login', array(
		                'div' => false,
		                'class' => 'btn',
		            )); ?>
		            <button class="btn">Cancel</button>
		        	</div>
        		</div>
    			</fieldset>
					<?php echo $this->Form->end(); ?>
				</form>
			</div>
		</div>
