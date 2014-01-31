<div class="contracts cake-form">
    <?php echo $this->Form->create('Contract'); ?>
    <fieldset>
        <legend>
            <?php echo __('Contract Details'); ?>
        </legend>
        <?php if(isset($getdata['Contract']['id'])) $id= $getdata['Contract']['id']; else $id ='';
        if(isset($getdata['Contract']['name'])) $name= $getdata['Contract']['name']; else $name= '';
        if(isset($getdata['Contract']['address'])) $address= $getdata['Contract']['address'];else $address = '';
        if(isset($getdata['Contract']['email_id'])) $email_id= $getdata['Contract']['email_id'];else $email_id='';
        if(isset($getdata['Contract']['phone_no'])) $phone_no= $getdata['Contract']['phone_no'];else $phone_no = '';
        if(isset($getdata['Contract']['mobile_no'])) $mobile_no= $getdata['Contract']['mobile_no'];else $mobile_no='';

        echo $this->Form->input('id',array('value'=>$id,'type'=>'hidden'));
        echo $this->Form->input('name',array('class'=>'form-control','value'=>$name));
        echo $this->Form->input('address',array('class'=>'form-control','value'=>$address));
        echo $this->Form->input('email_id',array('type'=>'text','class'=>'form-control','onblur'=>'validate_email(this.value);','value'=>$email_id,
                                                  'after'=>'<div id="warning-message" class="text-danger"></div>'));
        echo $this->Form->input('phone_no',array('class'=>'form-control','value'=>$phone_no,'onblur'=>'validatePhone(this);','after'=>'<div id="warning-message-ContractPhoneNo" class="text-danger"></div>'));
        echo $this->Form->input('mobile_no',array('class'=>'form-control','value'=>$mobile_no,'onblur'=>'validatePhone(this);','after'=>'<div id="warning-message-ContractMobileNo" class="text-danger"></div>'));
        ?>
    </fieldset>
    <?php
    echo $this->Form->submit('Save',array('class' => 'btn btn-primary',
                                          'after' => '&nbsp;&nbsp;&nbsp;&nbsp;'.$this->Html->link('Cancel',array('action'=>'contractlist'),array('class' => 'btn btn-danger')))); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>