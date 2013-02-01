<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
		'role' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 80),
		'active' => array('type' => 'integer', 'null' => false, 'default' => 1, 'length' => 80),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

}
