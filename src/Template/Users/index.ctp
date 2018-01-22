<ol class="breadcrumb">
  <li class="active">Users</li>
</ol>

<?php if ($this->request->session()->read('Auth.User.role') =='admin'): ?>
<p class="pull-right"><?php echo $this->Html->link(__('User Admin'), ['action'=>'index','prefix'=>'admin'], ['class'=>'btn btn-primary']); ?></p>
<?php endif; ?>

<h3><?= __('Users') ?></h3>
<table class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('first_name') ?></th>
      <th><?= $this->Paginator->sort('last_name') ?></th>
      <th><?= $this->Paginator->sort('username') ?></th>
      <th><?= $this->Paginator->sort('role') ?></th>
      <th><?= $this->Paginator->sort('email') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><?= h($user->first_name) ?></td>
      <td><?= h($user->last_name) ?></td>
      <td><?= $this->Html->link($user->username, ['action' => 'view', $user->username]) ?></td>
      <td><?= h($user->role) ?></td>
      <td><?= h($user->email) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
