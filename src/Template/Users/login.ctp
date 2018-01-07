<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Please log in') ?></legend>
            <?= $this->Form->input('username') ?>
            <?= $this->Form->input('password') ?>
            <?= $this->Form->input('remember_me',['type'=>'checkbox']); ?>
        </fieldset>
    <?= $this->Form->button(__('Sign in')); ?>
    <?= $this->Form->end() ?>

    <p class="text-right"><?php echo $this->Html->link('Forgot your password?', array('controller'=>'users', 'action'=>'requestResetPassword'), array('class'=>''));?></p>

  </div>
</div>



