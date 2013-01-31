submenu_indicators.ctp

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="nav-collapse">
        <ul class="nav">
          <?php if( AuthComponent::user('id') ) { ?>
          <li class="<?php echo $this->params->controller == 'indicators' && $this->action == 'calcul' ? 'active' : '';  ?>">
            <?php echo $this->Html->link(__('Indicators'),array('controller' => 'indicators','action' => 'calcul')) ?>
          </li>
          <li class="<?php echo $this->params->controller == 'dates' && $this->action == 'views' ? 'active' : '';  ?>">
            <?php echo $this->Html->link(__('Data entered'),array('controller' => 'dates','action' => 'views')) ?>
          </li>
          <li class="<?php echo $this->params->controller == 'reports' && $this->action == 'do' ? 'active' : '';  ?>">
            <?php echo $this->Html->link(__('Reporting'),array('controller' => 'reports','action' => 'do')) ?>
          </li>
          <?php if ( AuthComponent::user('role') == 'admin' ) { ?>
          <li class="<?php echo $this->params->controller == 'users' && $this->action == 'index' ? 'active' : '';  ?>">
            <?php echo $this->Html->link(__('Administrator'),array('controller' => 'users','action' => 'index')) ?>
          </li>
          <?php } ?>
          <?php } else { ?>
          <li class="<?php echo $this->params->controller == 'users' && $this->action == 'login' ? 'active' : ''; ?>">
            <?php echo $this->Html->link(__('Login'),array('controller' => 'users','action' => 'login')) ?>
          </li>
          <li class="<?php echo $this->params->controller == 'users' && $this->action == 'register' ? 'active' : ''; ?>">
            <?php echo $this->Html->link(__('Register'),array('controller' => 'users','action' => 'register')) ?>
          </li>
          <?php } ?>
          
        </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>