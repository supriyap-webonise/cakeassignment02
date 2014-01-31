<?php
class ProjectsController extends AppController
{
	public $helpers = array('Project');

    public function index()
    {
        $this->Project->recursive = 0;
    }
    //get category list
    public function projectlist()
    {
        $getcontracts = $this->Project->getcontracts();
        $this->set('getcontracts',$getcontracts);
    }
    //get Project list
    public function categoryprojectlist($categoryid)
    {
        $this->layout = 'ajax';
        if($categoryid!='')
        {
            $result = $this->Project->projectlist($categoryid);
            $this->set('result',$result);
        }
    }
    //For add project record
    public function add()
    {
       $technology = ClassRegistry::init('Technology')->find('list', array('fields'=>array('id','name')));
        $this->set('technology',$technology);
       $getcontracts = $this->Project->getcontracts();
       $this->set('getcontracts',$getcontracts);

        if($this->request->is('post'))
        {
        	$this->request->data['Project']['technology'] = implode(',',$this->request->data['Project']['technology']);
            $this->Project->create();
            if($projectid = $this->Project->Save($this->request->data))
            {
                return $this->redirect(array('action'=>'projectlist'));
            }
        }
    }
    //For edit project record
    public function edit()
    {
    	$technology = ClassRegistry::init('Technology')->find('list', array('fields'=>array('id','name')));
        $this->set('technology',$technology);
        $getcontracts = $this->Project->getcontracts();
        $this->set('getcontracts',$getcontracts);

        if(isset($this->params['named']['id']) && $this->params['named']['id']!='')
        {
            $getdata = $this->Project->find('first',array('fields'=>array('Project.id','Project.name','Project.contact_person','Project.start_date','Project.end_date','Project.technology','Project.contract_id'),
                                                            'conditions'=>'Project.id='.$this->params['named']['id']));
            $getdata['Project']['technology']=explode(',',$getdata['Project']['technology']);
            $this->set('getdata',$getdata);
        }
        if($this->request->is('post'))
        {
            $this->request->data['Project']['technology'] = implode(',',$this->request->data['Project']['technology']);
            echo $this->request->data['Project']['technology'];
            $this->Project->create();
           if($projectid = $this->Project->Save($this->request->data))
           {
               $this->Session->setFlash(__("Saved Successfully..."));
           }
           return $this->redirect(array('action'=>'edit','id'=>$this->params['named']['id']));
        }
    }
    //allocated employee to particular project
    public function allocate()
    {
    	$getTechId = $this->Project->find('first',array('fields'=>array('technology'),
                		                    'conditions'=>'Project.id='.$this->params['named']['id']));
        $technology = ClassRegistry::init('Technology')->gettechnology($getTechId ['Project']['technology']);
        $this->set('technology',$technology);
    }
    //employees according to selected technology
    public function technologyemployee($tech_id,$project_id=null)
    {
        $this->layout = 'ajax';
        $tech_employee = ClassRegistry::init('Employee')->find('all', array('fields'=>array('id','name','work_load'),
                                                                            'conditions'=>'Employee.technology_id='.$tech_id));
        $this->set('project_id',$project_id);
        $this->set('tech_id',$tech_id);
        $this->set('tech_employee',$tech_employee);
    }
    //allocate employee to project
    public function allocateToProject($project_id,$user_id,$work_load)
    {
    	$this->autoRender = false;
    	$data = array();
    	$ProjectEmployee = ClassRegistry::init('ProjectEmployee');
    	$Employee = ClassRegistry::init('Employee');
    	$data['ProjectEmployee']['projectid'] = $project_id;
    	$data['ProjectEmployee']['employeeid'] = $user_id;
    	
    	$allocationExists = $ProjectEmployee->find('first',array('fields'=>array('id','allocate'),
                                                                  'conditions'=>array('ProjectEmployee.projectid'=> $project_id,'ProjectEmployee.employeeid' => $user_id)));
    	if(!empty($allocationExists)){
    		$data['ProjectEmployee']['id'] = $allocationExists['ProjectEmployee']['id'];
    		if($work_load > $allocationExists['ProjectEmployee']['allocate']){
    			$data['ProjectEmployee']['allocate'] = $allocationExists['ProjectEmployee']['allocate'] + $work_load;
    		}else{
    			$data['ProjectEmployee']['allocate'] = $allocationExists['ProjectEmployee']['allocate'] - $work_load;
    		}
    		
    	}else{
    		$data['ProjectEmployee']['allocate'] = $work_load;
    	}
    	
    	if($ProjectEmployee->save($data)){
    		//Calculate userwork load
    		$userWorkLoad = $ProjectEmployee->find('all', array(
                                                    'fields' => array('sum(ProjectEmployee.allocate) as total_work_load'),
												    'conditions' => array('ProjectEmployee.employeeid' => $user_id)
												        )
												    );
												    
    		//Update in user
    		$employee = $Employee->find('first',array('fields'=>array('id','work_load'),'conditions'=>array('Employee.id'=>$user_id)));
    		$empData['Employee']['id'] = $employee['Employee']['id'];
    		$empData['Employee']['work_load'] = $userWorkLoad[0][0]['total_work_load'];
    		$Employee->save($empData);
    		return true;
    	}
    	return false;
    }
    //unallocate employee to particular project
    public function unallocate($projectemployeeid,$user_id,$tech_id,$project_id){
        $this->autoRender = false;
        $data = array();
        $ProjectEmployee = ClassRegistry::init('ProjectEmployee');
        $Employee = ClassRegistry::init('Employee');

        if($ProjectEmployee->delete($projectemployeeid)){
            //Calculate userwork load
            $userWorkLoad = $ProjectEmployee->find('all', array('fields' => array('sum(ProjectEmployee.allocate) as total_work_load'),
                                                                'conditions' => array('ProjectEmployee.employeeid' => $user_id)
                                                            )
                                                        );
            if($userWorkLoad[0][0]['total_work_load']=='') $userWorkLoad[0][0]['total_work_load']=0;
            //Update in user
            $employee = $Employee->find('first',array('fields'=>array('id','work_load'),
                                                      'conditions'=>array('Employee.id'=>$user_id)));
            if(isset($employee['Employee']['id']))
            $empData['Employee']['id'] = $employee['Employee']['id'];
            $empData['Employee']['work_load'] = $userWorkLoad[0][0]['total_work_load'];
            $Employee->save($empData);
            return true;
        }
        return false;
    }
}
