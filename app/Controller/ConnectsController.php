<?php
App::uses('AppController', 'Controller');
class ConnectsController extends AppController {
/**
 * Authorized
 */

        public function isAuthorized($user) {

           	if (in_array($this->action, array('connectto'))) {
                        $nodeId = $this->request->params['pass'][0];
                        if ($this->Connect->isOwnedBy($nodeId, $user['id'], $this->data)) {
                                return true;
                        }
                }

       		return parent::isAuthorized($user);
        }


/* ConnectTo with checkbox */	
	public function connectto($id = null) {
		$varname = "node_connectto_id_";

		$node_act = $this->Connect->Node->read(null, $id);
		$node_id = $node_act['Node']['id'];
                if ($this->request->is('post') || $this->request->is('put')) {
			foreach($this->data['Connect'] as $k=>$v){
				$ct_id = substr($k,strlen($varname));
				$val = $this->Connect->find('count',array('conditions'=>array('Connect.node_id' => $node_id,'Connect.node_connectto_id' => $ct_id)));
				if (!$val && $v) {
					/* Abans no hi era i ara si s'ha de crear */
					$this->Connect->create();
                        		$this->Connect->save(array('Connect' => array('node_id' => $node_id,'node_connectto_id' => $ct_id, 'user_id' => $this->Auth->user('id'))));
				} elseif ( $val && !$v) {
					/* Abans estava ara no, s'ha d'esborrar */
					$this->Connect->DeleteAll(array('Connect.node_id' => $node_id, 'Connect.node_connectto_id' => $ct_id),false);
				}

			}
			$this->redirect(array('controller'=>'networks', 'action' => 'view', $node_act['Node']['network_id']));
		}
		// Filtrar per Network.
		$this->Connect->unbindmodel(array('belongsTo' => array('Connectto')));
		$nodes = $this->Connect->Node->find('list',array('conditions'=>array('Node.network_id' => $node_act['Node']['network_id'] , 'Node.id <>' => $node_act['Node']['id'] )));
		$connecttos = $this->Connect->find('list',array('conditions'=>array('Connect.node_id' => $node_id), 'fields' => array('Connect.node_connectto_id')));
		foreach($connecttos as $connectto) {
			$this->request->data['Connect'][$varname.$connectto] = 1;
		}
		$this->set(compact('varname'));
		$this->set('node_id',$node_id);
		$this->set(compact('connecttos','nodes'));
	}
}
