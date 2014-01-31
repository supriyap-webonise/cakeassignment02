<div class="users">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User',array('class'=>'form-login')); ?>
    <fieldset>
        <h5 class="text-danger">
            <?php echo __('Please enter your username and password'); ?>
        </h5>
        <?php echo $this->Form->input('username',array('class'=>'form-control','placeholder'=>'Email address','required'=>'required',''=>'autofocus'));
        echo $this->Form->input('password',array('class'=>'form-control','placeholder'=>'Password','required'=>'required'));
        ?>
    </fieldset>
    <?php
    $options = array(
        'label' => 'Login',
        'class' => 'btn btn-lg btn-success btn-block btn-default',
        'div' => array(
            'class' => 'pull-right',
        )
    );
    echo $this->Form->end($options); ?>
</div>