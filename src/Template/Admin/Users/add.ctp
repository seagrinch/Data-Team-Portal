<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Users'), ['controller'=>'Users', 'action' => 'index']) ?></li>
  <li class="active">Add New User</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add a new User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('password_confirm', ['type'=>'password','label'=>'Confirm your new password']);
            echo $this->Form->input('email');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('role',['options' => [
                'user'=>'Basic User', 
                'data'=>'Data Evaluator', 
                'marine'=>'Marine Operator', 
                'admin' => 'Admin']]);
        ?>
    </fieldset>

		<?= $this->Html->link('Cancel', ['action' => 'index'], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
