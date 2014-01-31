<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
<div class="projects formStyle cake-form">
    <?php echo $this->Form->create('Project',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend>
            <?php echo __('Project Details'); ?>
        </legend>

        <?php
        if(isset($getdata['Project']['id'])) { $id= $getdata['Project']['id']; $style='display:block;';} else { $id =''; $style='display:none;';}
        if(isset($getdata['Project']['name'])) $name= $getdata['Project']['name']; else $name= '';
        if(isset($getdata['Project']['contract_id'])) $contract_id= $getdata['Project']['contract_id']; else $contract_id= '';
        if(isset($getdata['Project']['contact_person'])) $contact_person= $getdata['Project']['contact_person']; else $contact_person= '';
        if(isset($getdata['Project']['start_date'])) $start_date= $getdata['Project']['start_date'];else $start_date = '';
        if(isset($getdata['Project']['end_date'])) $end_date= $getdata['Project']['end_date'];else $end_date='';
        if(isset($getdata['Project']['resource'])) $resource= $getdata['Project']['resource'];else $resource = '';
        echo $this->Form->input('id',array('value'=>$id,'type'=>'hidden'));
        echo $this->Form->input('contract_id', array(
            'options' =>$getcontracts,
            'selected' =>$contract_id

        ));
        echo $this->Form->input('name',array('class'=>'form-control','value'=>$name));
        echo $this->Form->input('contact_person',array('class'=>'form-control','value'=>$contact_person));?>
        <div class="clearfix checkboxOuter">
            <?php
            echo $this->Form->input('technology', array(
                                    'options'=>$technology,
                                    'type'=>'select',
                                    'multiple' => 'checkbox'
            ));?>
        </div>

        <label>Start Date</label>
        <div id="datetimepicker" class="input-append date">
            <input type="text" name="data[Project][start_date]" id="Projectstart_date"  value="<?php echo $start_date;?>"  class="form-control"/>
              <span class="add-on add-on1">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>

        </div>
        <label>End Date</label>
        <div id="datetimepicker1" class="input-append date">
            <input type="text" name="data[Project][end_date]" id="Projectend_date"  value="<?php echo $end_date;?>" class="form-control">
              <span class="add-on add-on1">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>
            </input>
        </div>
    </fieldset>
    <?php
    echo $this->Form->submit('Save',array('class' => 'btn btn-primary',
                                          'after'=>  '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link("Cancel",array('action'=>'projectlist'),array("type"=>"button","class"=>"btn btn-danger"))));?>

    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
    $('#datetimepicker1').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
    });
    $('#ProjectAddForm').submit(function(){
        if ( $("input:checked").length == 0) {
            return false;
        }
    });
</script>