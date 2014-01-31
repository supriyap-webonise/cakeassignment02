<?php
class ProjectHelper extends AppHelper { 
	
	public function getAllocationForProject($user_id,$project_id)
    {
        $work_load = null;
        $ProjectEmployee = ClassRegistry::init('ProjectEmployee');
        $allocatedWorkLoad = $ProjectEmployee->find('first',array('fields'=>array('id','allocate'),'conditions'=>array('ProjectEmployee.projectid'=> $project_id,'ProjectEmployee.employeeid' => $user_id)));
        if(!empty($allocatedWorkLoad))
        {
            $work_load['id'] = $allocatedWorkLoad['ProjectEmployee']['id'];
            $work_load['work_load'] = $allocatedWorkLoad['ProjectEmployee']['allocate'];
        }
        return $work_load;
	}
}