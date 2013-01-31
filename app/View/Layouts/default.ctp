<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo Configure::read('Application.name') ?> - <?php echo !empty($title_for_layout) ? $title_for_layout : ''; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
 		echo $this->Html->css('normalize.css');
  	echo $this->Html->css('bootstrap-'.$theme.'.min', null, array('data-extra' => 'theme'));
  	echo $this->Html->css('bootstrap-responsive.min');
  	echo $this->Html->css('style');
	  if (is_file(WWW_ROOT . 'css' . DS . $this->params->controller . '.css')) {
	  	echo $this->Html->css($this->params->controller);
	  }
	  if (is_file(WWW_ROOT . 'css' . DS . $this->params->controller . DS . $this->params->action . '.css')) {
	  	echo $this->Html->css($this->params->controller . '/' . $this->params->action);
	  }
	?>
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->
  <?php echo $this->element('menu'); ?>
  <div class="container" role="main" id="main">

<div class="row-fluid">
	<div class="hero-unit">
		<div class="row-fluid">
    <?php echo $this->Session->flash();?>
    <?php echo $this->fetch('content'); ?>
		</div>

	</div>
</div>
		<?php echo $this->element('footer'); ?>
  </div> <!-- /container -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo $this->params->webroot ?>js/lib/jquery.min.js"><\/script>')</script>

  <?php
  if (is_file(WWW_ROOT . 'js' . DS . $this->params->controller . '.js')) {
  echo $this->Html->script($this->params->controller);
  }
  if (is_file(WWW_ROOT . 'js' . DS . $this->params->controller . DS . $this->params->action . '.js')) {
  echo $this->Html->script($this->params->controller . '/' . $this->params->action);
  }
  ?>

  <?php echo $this->Html->script(
    array(
      'lib/bootstrap.min',
      'lib/modernizr'
      ));
      ?>
</body>
</html>
