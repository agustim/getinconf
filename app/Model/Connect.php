<?php
App::uses('AppModel', 'Model');
class Connect extends AppModel {

	public $useTable = 'connect';


	public $belongsTo = array(
		'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'node_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Connectto' => array(
			'className' => 'Node',
			'foreignKey' => 'node_connectto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

        public function isOwnedBy($node, $user, $data) {
	 	// OjO s'hauria de validar que tots els nodes implicats son del usuari.	
                //return $this->field('node_id', array('node_id' => $node, 'user_id' => $user)) === $node;
		return true;
        }


}
