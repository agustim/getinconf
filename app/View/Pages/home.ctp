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
				<hr>
				<?php echo $this->element('check_cakephp'); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="<?php echo $span_content; ?>">

			<h3>Phasellus</h3>
<p>Phasellus massa velit, cursus vel accumsan eu, varius vitae tortor. Etiam urna leo, hendrerit non suscipit sed, fermentum nec ipsum. Nunc a erat lorem, vel suscipit sem. Aliquam tellus nunc, posuere nec luctus eget, posuere a ipsum. Pellentesque consectetur augue eu arcu accumsan eu volutpat lorem lobortis. Duis nec iaculis dui. Vestibulum eu tortor magna. Donec vitae dapibus diam. Morbi neque nunc, egestas sed posuere malesuada, accumsan ut neque. Pellentesque et orci volutpat turpis feugiat venenatis. Quisque molestie tempus sapien in vestibulum. Pellentesque feugiat pellentesque lacus sit amet convallis. Morbi eleifend dictum suscipit. Suspendisse at nibh ac turpis rutrum tincidunt. Phasellus sollicitudin turpis eu ligula pulvinar mattis.</p>
			<hr>
			<h3>Pellentesque</h3>
<p>Pellentesque eget ligula velit. Duis neque velit, scelerisque a laoreet id, lobortis sit amet nisi. Mauris fermentum condimentum metus, ac varius arcu ornare in. Proin a tellus velit. Donec pharetra arcu sed quam volutpat ultricies. Aenean sit amet augue ligula, vel ornare purus. Aliquam ornare vehicula mi, in pulvinar mi facilisis a. Pellentesque pellentesque orci sit amet nibh adipiscing sodales. Sed sit amet metus odio. Vivamus sodales commodo rhoncus. Nullam vitae dolor ligula, sit amet hendrerit risus.</p>

			</div>
			<?php if ($span_login) { ?>
			<div class="span4">
				<?php echo $this->element('form_login') ?>
			</div>		
			<?php } ?>
