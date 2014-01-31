<?php class Project extends AppModel
{
    //association of contracts with project to get projects associated with particular contract
    public $belongsTo =array(
        'Contract' => array(
            'className' => 'Contract',
            'foreignKey' => 'contract_id'
        )
    );
    //get project list associted with contract
    public function projectlist($contractid)
    {
        $result = $this->find('all',array('fields'=>array('Project.id','Project.name','Project.contact_person','Project.start_date','Project.end_date','Project.resource','Project.contract_id'),
                                            'conditions'=>'Project.contract_id='.$contractid));
        return $result;
    }
    //get contract data for dropdown
    public function getcontracts()
    {
        return $this->Contract->find('list',array('fields' => array('id','name')));
    }
}
