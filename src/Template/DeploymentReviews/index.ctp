<h3><?= __('Deployment Reviews') ?></h3>

<p class="text-right"><?php echo $this->Html->link(__('Create a New Review'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('reference_designator') ?></th>
      <th scope="col"><?= $this->Paginator->sort('deployment') ?></th>
      <th scope="col"><?= $this->Paginator->sort('status') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Users.username', 'Reviewer') ?></th>
      <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($deploymentReviews as $deploymentReview): ?>
      <tr>
        <td><?= $this->Html->link($deploymentReview->reference_designator, ['controller'=>'instruments', 'action' => 'view', $deploymentReview->reference_designator]) ?></td>
        <td><?= $this->Number->format($deploymentReview->deployment_number) ?></td>
        <td><?= h($deploymentReview->status) ?></td>
        <td><?= $deploymentReview->has('user') ? $this->Html->link($deploymentReview->user->username, ['controller' => 'Users', 'action' => 'view', $deploymentReview->user->username]) : '' ?></td>
        <td><?= $this->Time->timeAgoInWords($deploymentReview->modified) ?></td>
        <td><?= $this->Html->link('Review', ['action' => 'view', $deploymentReview->reference_designator, $deploymentReview->deployment_number],['class'=>'btn btn-default btn-sm']) ?></td>
      </tr>
      <?php endforeach; ?>
  </tbody>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
