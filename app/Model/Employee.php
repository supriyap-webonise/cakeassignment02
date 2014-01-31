<?php class Employee extends AppModel
{
    public $actsAs = array('CsvImport');
    //association of technology with employee
    public $belongsTo =array(
        'Technology' => array(
            'className' => 'Technology',
            'foreignKey' => 'technology_id'
        )
    );
}
