<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Users'), ['controller'=>'Users', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($user->full_name, ['controller'=>'Users', 'action' => 'view', $user->id]) ?></li>
  <li class="active">User Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend>Edit <?= $user->full_name?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password', [
              'label'=>'New password', 
              'help'=>'Leave this blank unless you want to change your password.',
              'required'=>false]);
            echo $this->Form->input('password_confirm', ['type'=>'password','label'=>'Confirm your new password']);
            echo $this->Form->input('email');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('role',['options' => [
                'data'=>'Data Evaluator', 
                'marine'=>'Marine Operator', 
                'admin' => 'Administrator']]);
        ?>
    </fieldset>

		<?= $this->Html->link('Cancel', ['action' => 'index'], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
