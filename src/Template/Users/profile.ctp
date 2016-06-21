<div class="row">
  <div class='col-md-6 col-md-offset-3'>
    
    <h3>Your Profile</h3>
    <dl class="dl-horizontal">
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
    </dl>

    <p class="text-right"><?php echo $this->Html->link('Edit your Profile', array('controller'=>'Users', 'action'=>'update'), array('class'=>'btn btn-info'));?></p>
    
  </div>
</div>
