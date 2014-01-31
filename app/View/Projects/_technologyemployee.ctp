<div id="tech_employee">
    <table>
        <tr>
            <td>Name</td>
            <td>Allocate to Project</td>
            <td>Total Allocation</td>
        </tr>
    <?php
    foreach ($tech_employee as $key=>$value) {
        echo  '<tr><td>'.$this->Form->input("Employee",
            array(
                'label'=>$value['Employee']['name'],
                'type'=>'checkbox',
                'value'=>$value['Employee']['id'],
                'name' => 'data[Employee]['.$value['Employee']['id'].']',
                'onclick' => '$("#load'.$value['Employee']['id'].'").removeAttr("readonly")'
            )
        ).'</td>';
       echo '<td>'.$value['Employee']['work_load'].'</td>';
       echo '<td>'. $this->Form->input('load'.$value['Employee']['id'],array('class'=>'form-control load_text','label'=>false, 'readonly'=>'readonly','name' => 'data[load]['.$value['Employee']['id'].']')).'</td></tr>';
    }
    /*echo $this->Form->input('employee', array(
        'label' => false,
        'type' => 'select',
        'multiple'=>'checkbox',
        'options' => $tech_employee,
        'after' => $this->Form->input('load',array('class'=>'form-control load_text'))
    ));*/
    ?>
    </table>
</div>