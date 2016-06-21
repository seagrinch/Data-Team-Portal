<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Change Your Password') ?></legend>
        <p>Please use this form to specify a new password for your account.</p>
        <?php
            echo $this->Form->input('password', ['label'=>'New password', 'help'=>'Passwords must be at least 6 characters long.']);
            echo $this->Form->input('password_confirm', ['type'=>'password','label'=>'Confirm your new password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Change Password')) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
