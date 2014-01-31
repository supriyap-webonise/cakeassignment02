<div class="container">
    <?php echo $this->Form->button('Add Project', array("type" => "button","onclick"=>"location.href='add'","class"=>"btn btn-info"));
    echo $this->Form->input('contract_id', array(
        'options' =>$getcontracts,
        'empty' => '(choose one)',
        'onchange' => 'getprojects(this)',
        'div' =>array('align' =>'center')
    ));?>
    <br>
<div id="projecttable">

</div>