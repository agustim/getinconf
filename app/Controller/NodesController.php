<?php
App::uses('AppController', 'Controller');
class NodesController extends AppController {
/**
 * Authorized
 */

        public function isAuthorized($user) {
        // All registered users can add nodes 
                if (in_array($this->action, array('index','add'))) {
                        return true;
                }

        // The owner of a node can edit and delete it
                if (in_array($this->action, array('edit', 'delete', 'view', 'configure'))) {
                        $nodeId = $this->request->params['pass'][0];
                        if ($this->Node->isOwnedBy($nodeId, $user)) {
                                return true;
                        }
                }

        return parent::isAuthorized($user);
	}

    	public function beforeFilter() {
        	parent::beforeFilter();
       		$this->Auth->allow('get','get2');
    	}

	public function index() {
		$this->Node->recursive = 0;
		$this->set('nodes', $this->paginate());
	}

	public function view($id = null) {
		$this->Node->id = $id;
		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		$this->set('node', $this->Node->read(null, $id));
	}

	public function add($network_id = null) {
		if (($this->Node->Network->find('count',array('conditions'=>array('Network.id'=>$network_id, 'Network.user_id'=>$this->Auth->user('id')))) == 1) ||
	           ($this->Auth->user('role') == 'admin')) {
			$this->Session->write('Network.id',$network_id);
		} else {
			$this->redirect(array('controller'=>'networks','action' => 'index'));
		}
		if ($this->request->is('post') && $this->Session->check('Network.id')) {
			$this->request->data['Node']['user_id'] = $this->Auth->user('id');
			$this->request->data['Node']['network_id'] = $this->Session->read('Network.id');
			$this->Node->create();
			if ($this->Node->save($this->request->data)) {
				$this->Session->setFlash(__('The node has been saved'));
				$this->redirect(array('controller'=>'networks','action' => 'view', $this->request->data['Node']['network_id']));
			} else {
				$this->Session->setFlash(__('The node could not be saved. Please, try again.'));
			}
		}
		$this->set('network_id',$network_id);
	}

	public function edit($id = null) {
		$this->Node->id = $id;
		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		if (($this->request->is('post') || $this->request->is('put')) && $this->Session->check('Network.id')) {
			$this->request->data['Node']['network_id'] = $this->Session->read('Network.id');
			if ($this->Node->save($this->request->data)) {
				$this->Session->setFlash(__('The node has been saved'));
				$this->redirect(array('controller'=>'networks','action' => 'view', $this->request->data['Node']['network_id']));
			} else {
				$this->Session->setFlash(__('The node could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Node->read(null, $id);
			$this->Session->write('Network.id',$this->request->data['Node']['network_id']);
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Node->id = $id;
		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		$node = $this->Node->read(null, $id);
		$network = $node['Network']['id'];
		if ($this->Node->delete()) {
			$this->Session->setFlash(__('Node deleted'));
			$this->redirect(array('controller'=>'networks','action' => 'view', $network));
		} 
		$this->Session->setFlash(__('Node was not deleted'));
		$this->redirect(array('controller'=>'networks','action' => 'view', $network));
	}

	public function _configure($id = null, $allconfig = 1, $encrypt = 1) {
		$this->Node->id = $id;
		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		$this->Node->unbindModel(
			array('hasMany' => array('Connectto','Connectfrom'))
			);
		$this->set('allconfig',$allconfig);
		$this->set('encrypt', $encrypt);
		$node = $this->Node->read(null, $id);
		$this->set('node', $node);
		if($node['Network']['automaticconnectto']) {
			if ($node['Node']['is_gateway']) {
				//$this->set('connectfrom',$this->Node->query("select Node.* from node Node where Node.network_id = ".$node['Node']['network_id']." and Node.id <> ".$id." and Node.address <> '' and Node.address is not null"));
				$this->set('connectfrom',$this->Node->query("select Node.* from node Node where Node.network_id = ".$node['Node']['network_id']." and Node.id <> ".$id));
			} else {
				$this->set('connectfrom',$this->Node->query("select Node.* from node Node where Node.network_id = ".$node['Node']['network_id']." and Node.is_gateway"));
			}
		} else {
			$this->set('connectfrom',$this->Node->query("select Node.* from connect c inner join node Node on (c.node_connectto_id = Node.id) where c.node_id = $id"));
		}
		$this->set('connectto',$this->Node->query("select Node.* from connect c inner join node Node on (c.node_id = Node.id) where c.node_connectto_id = $id"));
		$this->response->type('text');
		//$this->layout='ajax';
		$this->render('genscript','ajax');
	}

	public function configure($id = null, $allconfig = 1, $encrypt = 1) {

		$this->_configure($id, $allconfig, $encrypt);

	}
	public function get($hash_node, $network_name = null, $mac = null, $name = null, $is_gateway = 0, $internal_ip = 0, $allconfig = 0){
		$this->_get($hash_node, $network_name, $mac, $name, $is_gateway, $internal_ip, $allconfig, 1);	
	}
	public function get2($hash_node, $network_name = null, $mac = null, $name = null, $is_gateway = 0, $internal_ip = 0, $allconfig = 0){
		$this->_get($hash_node, $network_name, $mac, $name, $is_gateway, $internal_ip, $allconfig, 0);	
	}


	public function _get($hash_node, $network_name = null, $mac = null, $name = null, $is_gateway = 0, $internal_ip = 0, $allconfig = 0, $encrypt = 1){

		$filename = "rsakeypub";
		
		// Si el sistema es trusted node, no hem de buscar-lo...

		$node = $this->Node->find('first',array('conditions'=> array('Node.hash_mac' => $hash_node)));
		
		if (!$this->request->is('post')) {
			if(!$node) {
				echo "Sorry Non-POST call & Non-exist Node.";
				exit(0);
			} else {
				$this->_configure($node['Node']['id'],$allconfig,$encrypt);
			}
			return(0);
		}
  
		$this->Node->Network->recursive = 0;
		$network = $this->Node->Network->find('first',array('conditions'=>array('Network.name'=>$network_name)));
	 	if(!$node) {
			// El sistema es trusted node?
			if ( ($network['Network']['trustednodes']) && 
			    ($network_name != null) && 
			    ($mac != null) &&
			    (md5(strtoupper(trim($mac)).$network['Network']['internalkey'].$network_name."\n") == $hash_node) 
			) {
				//Creem el mínim de les dades.
				$node = array('Node'=>
				array(	'user_id'=>$network['Network']['user_id'],
					'mac'=>$mac,
					'name'=>"",
					'device'=>'/dev/net/tun',
					'bitmask' => 32,
					'ip' => $this->_nextIP($network['Network']['id']),
					'network_id'=>$network['Network']['id'],
					'is_gateway'=>$is_gateway
					)
				);
				if($internal_ip != 0) { $node['Node']['address'] = $internal_ip; }
                        	$this->Node->create();
			} else {
				throw new MethodNotAllowedException();
			/*	echo md5(strtoupper(trim($mac)).$network['Network']['internalkey'].$network_name."\n");
				exit(0);*/
			}
		}
		/* Define Node Name */
		if ($name == null) {
			$name = $node['Network']['name'].substr($hash_node,-6); 
		}
		if ($node['Node']['name'] == "") {
			$node['Node']['name']=$name;
		}
		/* Get File by POST */
		if($_FILES[$filename]['size'] > 0) {
			$tmpFilename = $_FILES[$filename]['tmp_name'];
			$fp = fopen($tmpFilename,'r');
			$content = fread($fp, filesize($tmpFilename));
			$content = addslashes($content);
			fclose($fp);
			$node['Node']['rsakeypub'] = $content;
		}
                if ($this->Node->save($node)) {
			$id =  (isset($node['Node']['id']))?$node['Node']['id']:$this->Node->id; 
			$this->_configure($id,$allconfig,$encrypt);
                } else {
			return(-1);
		}
	}
	
	public function _nextIP($network_id = null) {
		/* Recuperar la IP de la xarxa */
		/* Passar a ip2long */
		$this->Node->Network->recursive = 0;
		$network = $this->Node->Network->find('first',array('conditions'=>array('Network.id'=>$network_id)));
                if (!$network) {
                        throw new NotFoundException(__('Invalid network'));
                }
		$max_ip_node = $this->Node->find('first',array('conditions'=>array('Node.network_id'=>$network_id),'order' => 'Node.longip DESC'));
		$ip_net = ip2long($network['Network']['ip']);
		$mask = $network['Network']['netmask'];
		$broadcast = ip2long('255.255.255.255');
		$broadcast = ~($broadcast << (32 - (int) $network['Network']['bitmask']));
		$ip_net_max = $ip_net |  $broadcast;
		$max_ip_exist = ip2long($max_ip_node['Node']['ip']);
		if (($max_ip_exist + 1) >= $ip_net_max ) { 
			// Es major el ip_net_max, buscar una ip lliure en el seu rang?
		} else {
			return long2ip($max_ip_exist+1);
		}
	}
}
