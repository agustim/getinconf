<?php
App::uses('AppController', 'Controller');
class NetworksController extends AppController {
/**
 * Authorized
 */

	public function isAuthorized($user) {
    	// All registered users can add posts
    		if (in_array($this->action, array('index','add'))) {
        		return true;
    		}

    	// The owner of a post can edit and delete it
    		if (in_array($this->action, array('edit', 'delete','view'))) {
        		$netId = $this->request->params['pass'][0];
        		if (($this->Network->isOwnedBy($netId, $user['id'])) || ($user['role'] == 'admin')) {
            			return true;
        		}
    		}

    	return parent::isAuthorized($user);
}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Network->recursive = 0;
		$this->Network->unbindModel(
			array('hasMany' => array ('Node'))
			);
		if($this->Auth->user('role') != "admin"){
			$this->set('networks', $this->paginate(array('Network.user_id'=>$this->Auth->user('id'))));
		} else {
			$this->Network->bindModel(
				array('belongsTo' => 
						array( 'User' => array('className' => 'User', 
											   'foreignKey' => 'user_id')
						)
					)
				);
			$this->set('networks', $this->paginate());
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Network->id = $id;
		if (!$this->Network->exists()) {
			throw new NotFoundException(__('Invalid network'));
		}
		$network = $this->Network->read(null, $id);
		if (($network['Network']['user_id'] != $this->Auth->user('id')) && ( $this->Auth->user('role') != 'admin')){
			$this->Session->setFlash(__('The network does not belong you.'), 'flash_fail');
			$this->redirect(array('action' => 'index'));		
		}
		$this->set('network', $network);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Network']['user_id'] = $this->Auth->user('id');
			$this->Network->create();
			if ($this->Network->save($this->request->data)) {
				$this->Session->setFlash(__('The network has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The network could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Network->id = $id;
		if (!$this->Network->exists()) {
			throw new NotFoundException(__('Invalid network'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Network->save($this->request->data)) {
				$this->Session->setFlash(__('The network has been saved'));
				$this->redirect(array('action' => 'index'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The network could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Network->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Network->id = $id;
		if (!$this->Network->exists()) {
			throw new NotFoundException(__('Invalid network'));
		}
		if ($this->Network->delete()) {
			$this->Session->setFlash(__('Network deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Network was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
