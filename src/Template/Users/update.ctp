<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit your profile') ?></legend>
        <?php
            echo $this->Form->input('username', ['disabled'=>true]);
            echo $this->Form->input('password', [
              'label'=>'New password', 
              'help'=>'Leave this blank unless you want to change your password.  Passwords must be at least 6 characters long.',
              'required'=>false]);
            echo $this->Form->input('password_confirm', ['type'=>'password','label'=>'Confirm your new password']);
            echo $this->Form->input('email');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'index'], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
