<div class="container">
    <?php echo $this->Form->button('Add Contract', array("type" => "button","onclick"=>"location.href='add'","class"=>"btn btn-info")); ?>
    <br/> <br/>
    <table class="table table-striped table-bordered">
        <tr>
            <td width="15%" >Name</td>
            <td width="15%" >Address</td>
            <td width="20%" >Email Id</td>
            <td width="20%" >Phone</td>
            <td width="15%" >Mobile</td>
        </tr>
        <?php foreach($result AS $key=>$value)
                {?>
                <tr class="active">
                    <td width="15%" class="fontcolor"><?php echo $this->Html->link($value['Contract']['name'],array('action'=>'edit','id'=>$value['Contract']['id']));?></td>
                    <td width="15%" class="fontcolor"><?php echo $value['Contract']['address'];?></td>
                    <td width="20%" class="fontcolor"><?php echo $value['Contract']['email_id'];?></td>
                    <td width="20%" class="fontcolor"><?php echo $value['Contract']['phone_no'];?></td>
                    <td width="15%" class="fontcolor"><?php echo $value['Contract']['mobile_no'];?></td>
                </tr>
        <?php   } ?>
    </table>
</div>