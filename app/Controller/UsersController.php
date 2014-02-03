<?php
class UsersController extends AppController {

    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users',  $this->User->find('all'));
    }
    //login of user
    public function login() {
        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                return $this->redirect($this->Auth->redirect(array('controller'=>'contracts','action' => 'contractlist')));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    //logout of user
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }
    //add new user
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
   }
