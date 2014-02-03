<div id="tech_employee">
    <?php
    $percentArr = array();
    for($percent=5;$percent<=100;$percent=$percent+5){
        $percentArr[$percent] = $percent;
    }
?>
    <table>
        <tr>
            <td>Name</td>
            <td>Total Allocation</td>
            <td>Allocate To Project</td>
            <?php if($project_end_date > 0){?>
            <td>Change Allocation</td>
                <?php } ?>
            <td>Allocate / Unallocate</td>
        </tr>
    <?php
    foreach ($tech_employee as $key=>$value) {
        echo  '<tr><td>'.$value['Employee']['name'].'</td>';
        $dangerClass = '';
        if($value['Employee']['work_load'] > 100){
        	$dangerClass = 'text-danger';
        }
       echo '<td class='.$dangerClass.'>'.$value['Employee']['work_load'].'</td>';
       $selname = 'allocation_unit_'.$value['Employee']['id'];

        $employeeallocate = $this->Project->getAllocationForProject($value['Employee']['id'],$project_id);
        if($employeeallocate=='')
        {
            $img = 'test-fail-icon.png';
            $title = 'Allocated Employee';
            
            if($project_end_date > 0){
           		$unallocateemp = 'allocate("'.$employeeallocate['work_load'].'",'.$value['Employee']['id'].')';
            }else{
            	$unallocateemp ='';
            }
        }
        else
        {
            $img = 'test-pass-icon.png';
            $title = 'Unallocate Employee';
            $unallocateemp = 'unalloate('.$employeeallocate['id'].','.$value['Employee']['id'].','.$tech_id.','.$project_id.')';
        }
       echo "<td>".$this->Form->input($selname, array(
            'type' => 'select',
            'class' => 'allocations',
        	'onchange' =>'',
        	'empty'=> 'Select one',
            'options' => $percentArr,
       		'label' =>false,
       		'disabled'=>'disabled',
       		'selected'=> $employeeallocate['work_load']
        ))."</td>";
        if($project_end_date > 0){
           echo '<td>'. $this->Html->image('/img/edit.png',array('title'=>'Change Allocation','onclick'=>'allocate("'.$employeeallocate['work_load'].'",'.$value['Employee']['id'].')')).'</td>';
        }
       echo '<td>'. $this->Html->image('/img/'.$img,array('title'=>$title,'onclick'=>$unallocateemp)).'</td></tr>';
    }
    ?>
    </table>
</div>