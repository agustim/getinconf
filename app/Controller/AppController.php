<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $helpers = array(
    'Session',
    'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
    'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
    'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator')
	);

	public $components = array(
    'Session',
    'Auth' => array(
        'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
        'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
        'authorize' => 'Controller'
    ),
    'DebugKit.Toolbar'
  );

  public function beforeFilter() {
      if (!$this->Session->check('Layout.theme')) {
        $theme = Configure::read('Layout.theme');
        $this->Session->write('Layout.theme',$theme);
        $this->set('theme',$theme);
      } else {
        $this->set('theme',$this->Session->read('Layout.theme'));
      }
      parent::beforeFilter();
  }

   public function isAuthorized($user) {

   }
}
