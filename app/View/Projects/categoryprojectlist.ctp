<table class="table table-striped table-bordered" id="project_list">
    <tr>
        <td width="15%" class="contract-listing-header">Name</td>
        <td width="20%" class="contract-listing-header">Contact Person</td>
        <td width="20%" class="contract-listing-header">Start Date</td>
        <td width="20%" class="contract-listing-header">End Date</td>
        <td width="5%" class="contract-listing-header">Allocate</td>
    </tr>
<?php $tr = '';
    foreach($result AS $key=>$value)
{
$tr .='<tr>
    <td width="15%" class="fontcolor">'.$this->Html->link($value["Project"]["name"],array('action'=>'edit','id'=>$value["Project"]["id"])).'</td>
    <td width="15%" class="fontcolor">'.$value['Project']['contact_person'].'</td>
    <td width="20%" class="fontcolor">'.$value['Project']['start_date'].'</td>
    <td width="20%" class="fontcolor">'.$value['Project']['end_date'].'</td>
    <td width="5%" class="fontcolor">'.$this->Html->link($this->Html->image('/img/allocate.png',array('width'=>'20px','height'=>'30px')),array('action'=>'allocate','id'=>$value["Project"]["id"]),array('escape'=>false)).'</td>
</tr>';
 }
    echo $tr; ?>
</table>
