<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel
{
    //public $useTable = 'tbl_user';
    public $validate = array(
                    'name' => array(
                    'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A username is required'
                    )
                    ),
    'password' => array(
                    'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                    )
                    )
    );
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
