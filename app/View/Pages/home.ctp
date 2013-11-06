<?php if( AuthComponent::user('id') ) {
		$span_content = "span12";
		$span_login = false;
	} else {
		$span_content = "span8";
		$span_login = true;
	}
?>

		<div class="span12">
			<h1><?php echo Configure::read('Application.name') ?> </h1>	
		</div>
		<div class="row-fluid">
			<div class="<?php echo $span_content; ?>">
			<hr/>
			</div>
			<?php if ($span_login) { ?>
			<div class="span4">
				<?php echo $this->element('form_login') ?>
			</div>		
		</div>
			<?php } ?>
