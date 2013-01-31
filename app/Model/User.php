<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $name = 'User';
    public $displayField = 'username';	
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'passwordlength' => array(
                'rule' => array('between', 6, 50),
                'message' => 'Enter 6-50 chars',
                'allowEmpty' => true
            ),             
            'passwordequal' => array(
                'rule' => 'checkpasswords',
                'message' => "Passwords don't match"
            ) 
        ),
        'confirm_password' => array(
            'passwordequal' => array(
                'rule' => 'checkpasswords',
                'message' => "Passwords don't match",
                'allowEmpty' => true
            ) 
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function checkpasswords()
    {
        return (strcmp($this->data[$this->alias]['password'],
                    $this->data[$this->alias]['confirm_password']) == 0);
    }

    public function beforeSave() {
        if ($this->data[$this->alias]['password'] == "") {
            unset($this->data[$this->alias]['password']);
            unset($this->data[$this->alias]['confirm_password']);
        }
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    public function isEmpty() {
        return !($this->find('count'));
    }
}