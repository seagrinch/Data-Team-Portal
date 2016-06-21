<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Users'), ['controller'=>'Users', 'action' => 'index']) ?></li>
  <li class="active"><?= h($user->full_name) ?></li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>
    
    <h3><?= h($user->full_name) ?></h3>
    <dl class="dl-horizontal">
      <dt><?= __('Id') ?></dt>
      <dd><?= $this->Number->format($user->id) ?></dd>
      <dt><?= __('Username') ?></dt>
      <dd><?= h($user->username) ?></dd>
      <dt><?= __('Email') ?></dt>
      <dd><?= h($user->email) ?></dd>
      <dt><?= __('First Name') ?></dt>
      <dd><?= h($user->first_name) ?></dd>
      <dt><?= __('Last Name') ?></dt>
      <dd><?= h($user->last_name) ?></dd>
      <dt><?= __('Role') ?></dt>
      <dd><?= h($user->role) ?></dd>
      <dt><?= __('Created') ?></dt>
      <dd><?= h($user->created) ?></dd>
      <dt><?= __('Modified') ?></dt>
      <dd><?= h($user->modified) ?></dd>
    </dl>

    <?php echo $this->Html->link('Edit User', array('controller'=>'Users', 'action'=>'edit', $user->id), array('class'=>'btn btn-primary pull-right'));?>
    <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->username), 'class'=>'btn btn-danger']) ?>

  </div>
</div>
