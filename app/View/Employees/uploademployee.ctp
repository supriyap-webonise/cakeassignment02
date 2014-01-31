<div class="contracts cake-form">
    <?php echo $this->Form->create('Employee',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend>
            <?php echo __('Upload Employee Details'); ?>
        </legend>
        <?php if(isset($errormessage))
        {?>
        <p class="text-danger"><?php echo $errormessage?></p>
        <?php }
        if(isset($successmessage))
        {
        ?>
        <p class="text-success"><?php echo $successmessage?></p>
        <?php } ?>
        <a href="../../uploads/osemployee.csv">Download Sample CSV</a>
        <?php
        echo $this->Form->input('upload_file',array('type'=>'file','class'=>'form-control','required'=>'required'));
        ?>
    </fieldset>
    <?php
    echo $this->Form->submit('Save',array('class' => 'btn btn-primary',
                                           'after' => '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Form->button("Cancel",array("type"=>"button","class"=>"btn btn-danger","onclick"=>"location.href='../contracts/contractlist'"))));
    echo $this->Form->end(); ?>
</div>

