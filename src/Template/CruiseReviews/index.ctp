<h3><?= __('Cruise Reviews') ?></h3>

<p class="text-right"><?php echo $this->Html->link(__('Create a New Review'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>

<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('cruise_cuid') ?></th>
      <th scope="col"><?= $this->Paginator->sort('status') ?></th>
      <th scope="col"><?= $this->Paginator->sort('ship_name') ?></th>
      <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
      <th scope="col"><?= $this->Paginator->sort('cruise_start_date') ?></th>
      <th scope="col"><?= $this->Paginator->sort('cruise_end_date') ?></th>
      <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($cruiseReviews as $cruiseReview): ?>
      <tr>
        <td><?= $this->Html->link($cruiseReview->cruise_cuid, ['action' => 'view', $cruiseReview->cruise_cuid]) ?></td>
        <td><?= h($cruiseReview->status) ?></td>
        <td><?= h($cruiseReview->cruise->ship_name) ?></td>
        <td><?= h($cruiseReview->cruise->notes) ?></td>
        <td><?= $this->Time->format($cruiseReview->cruise->cruise_start_date, 'MM/dd/yyyy') ?></td>
        <td><?= $this->Time->format($cruiseReview->cruise->cruise_end_date, 'MM/dd/yyyy') ?></td>
        <td><?= h($cruiseReview->modified) ?></td>
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
