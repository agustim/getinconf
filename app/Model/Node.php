<?php
App::uses('AppModel', 'Model');

class Node extends AppModel {

	public $useTable = 'node';

	//public $virtualFields = array( 'fullname' => "CONCAT(Node.name, '(', Node.mac, ')')", 'longip' => "INET_ATON(Node.ip)");
	public $virtualFields = array('fullname' => "Node.name || '(' || Node.mac || ')'", 'longip' => "Node.ip");
	public $displayField = 'fullname';

	public $validate = array(
		'network_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $belongsTo = array(
		'Network' => array(
			'className' => 'Network',
			'foreignKey' => 'network_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	public function beforeSave( $options = array() ) {
		$this->Network->recursive = 0;
		$net_key = $this->Network->find('first',array('fields'=>array('Network.internalkey','Network.name'),'conditions'=>array('Network.id'=>$this->data['Node']['network_id'])));
		$this->data['Node']['hash_mac'] = md5(strtoupper(trim($this->data['Node']['mac'])).$net_key['Network']['internalkey'].$net_key['Network']['name']."\n");
	}

        public function isOwnedBy($node, $user) {
                return (($user['role'] == 'admin') || ($this->field('id', array('id' => $node, 'user_id' => $user['id'])) === $node));
        }

}

