  <style>
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  </style>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <?php echo $this->Html->link( Configure::read('Application.name') ,"/",array('class' => 'brand')) ?>
      <div class="nav-collapse">
        <ul class="nav">
          <?php if( AuthComponent::user('id') ) { ?>
          <!-- Options -->
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


        <ul class="nav pull-right">
          <li id="fat-menu" class="dropdown">
            <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo __('Themes') ?><b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <?php 
                  $arrThemes = array('amelia' => 'Amelia','cerulean' => 'Cerulean', 'cyborg' => 'Cyborg',
                    'journal'=>'Journal', 'readable' => 'Readable', 'simplex' => 'Simplex', 
                    'slate' => 'Slate', 'spacelab' => 'Spacelab', 'spruce' => 'Spruce',
                    'superhero' => 'Superhero', 'united' => 'United', 'default' => 'Default'
                    );

                  foreach($arrThemes as $k=>$v) {
                    echo '<li>';
                    $clase = "change-theme";
                    if ($k == $theme) { $clase .=" active"; }
                    echo $this->Html->link(
                      $v,array('controller'=>'pages', 'action'=>'theme', $k),
                      array(
                       'tabindex' => '-1',
                       'escape' => false,
                       'class' => $clase,
                       'alt' => $k
                       )
                      );
                    echo '</li>';
                    } ?>
            </ul>
          </li>
        <?php if( AuthComponent::user('id') ) { ?>
          <li id="fat-menu" class="dropdown">
            <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-black icon-user"></i> 
              <?php echo AuthComponent::user('username') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li>
                  <?php echo $this->Html->link(
                    '<i class="icon-black icon-off"></i> Logout','/users/logout',
                    array(
                      'tabindex' => '-1',
                      'escape' => false
                      )
                      ) ?>
                </li>
              </ul>
            </li>
        <?php } ?>
          </ul>   

        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
