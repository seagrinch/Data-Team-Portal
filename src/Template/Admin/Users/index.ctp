<h3><?= __('Users') ?></h3>
<table class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('id') ?></th>
      <th><?= $this->Paginator->sort('username') ?></th>
      <th><?= $this->Paginator->sort('email') ?></th>
      <th><?= $this->Paginator->sort('first_name') ?></th>
      <th><?= $this->Paginator->sort('last_name') ?></th>
      <th><?= $this->Paginator->sort('role') ?></th>
      <th><?= $this->Paginator->sort('created') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><?= $this->Number->format($user->id) ?></td>
      <td><?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?></td>
      <td><?= h($user->email) ?></td>
      <td><?= h($user->first_name) ?></td>
      <td><?= h($user->last_name) ?></td>
      <td><?= h($user->role) ?></td>
      <td><?= $this->Time->timeAgoInWords($user->created) ?></td>
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

<p class="text-right"><?php echo $this->Html->link(__('Add a New User'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>
