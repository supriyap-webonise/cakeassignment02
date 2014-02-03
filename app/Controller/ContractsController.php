<?php
class ContractsController extends AppController
{

    public function index()
    {
        $this->Contract->recursive = 0;
    }
    //get contract list
    public function contractlist()
    {
        $result = AppController::getcache('Allcategory');
        if (!$result || (isset($this->request->params['named']['cache']) && $this->request->params['named']['cache']=='true'))
        {
                $result = $this->Contract->find('all');
                AppController::removecache('Allcategory');
                AppController::setcache('Allcategory',$result);
        }
        $this->set('result',$result);
    }

    //For add  contract record
    public function add()
    {
        if($this->request->is('post'))
        {
            $this->Contract->create();
            if($this->Contract->Save($this->request->data))
            {
                return $this->redirect(array('action'=>'contractlist','cache'=>'true'));
            }
        }
    }
    //edit contract record
    public function edit()
    {
        if(isset($this->params['named']['id']) && $this->params['named']['id']!='')
        {
            $getdata = $this->Contract->find('first',array('conditions'=>'id='.$this->params['named']['id']));
            $this->set('getdata',$getdata);
        }
        if($this->request->is('post'))
        {
            $this->Contract->create();
            if($this->Contract->Save($this->request->data))
            {
                return $this->redirect(array('action'=>'contractlist','cache'=>'true'));
            }
        }
    }
}
