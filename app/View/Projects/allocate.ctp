<div class="container">
    <?php echo $this->Form->create('Allocate'); ?>
    <fieldset>
        <legend>
            <?php echo __('Allocate Resources'); ?>
        </legend>
        <div style="float:left; width: 100px;">
        <?php
        echo $this->Form->input('project_id',array('value'=>$this->params['named']['id'],'type'=>'hidden'));
        echo $this->Form->input('technology_id', array(
            'type' => 'select',
            'class' => 'technology_checkbox',
        	'onchange' =>'javascript:loadUser();',
            'options' => $technology
        ));
        ?></div>
        <div id="tech_employee"></div>
    </fieldset>
    <?php
    echo $this->Html->link('Cancel',array('action'=>'projectlist'),array('class' => 'btn btn-danger pull-right')); ?>
</div>
<?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        loadUser();
    });
</script>
