<h3><?= __('Cruise Reviews') ?></h3>

<p class="text-right"><?php echo $this->Html->link(__('Create a New Review'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>

<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('cruise_cuid') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Cruises.ship_name', 'Ship Name') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Cruises.notes', 'Title') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Cruises.cruise_start_date', 'Start Date') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Cruises.cruise_end_date','End Date') ?></th>
      <th scope="col"><?= $this->Paginator->sort('status', 'Review Status') ?></th>
      <th scope="col"><?= $this->Paginator->sort('Users.username', 'Reviewer') ?></th>
      <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($cruiseReviews as $cruiseReview): ?>
      <tr>
        <td><?= $this->Html->link($cruiseReview->cruise_cuid, ['controller'=>'cruises', 'action' => 'view', $cruiseReview->cruise_cuid]) ?></td>
        <td><?= h($cruiseReview->cruise->ship_name) ?></td>
        <td><?= h($cruiseReview->cruise->notes) ?></td>
        <td><?= $this->Time->format($cruiseReview->cruise->cruise_start_date, 'MM/dd/yyyy') ?></td>
        <td><?= $this->Time->format($cruiseReview->cruise->cruise_end_date, 'MM/dd/yyyy') ?></td>
        <td>
          <?php
            $txt = ($cruiseReview->status) ? $cruiseReview->status : 'New';
            echo $this->Html->link($txt, ['action' => 'view', $cruiseReview->cruise_cuid],['class'=>'']) 
          ?>
        </td>
        <td><?= $cruiseReview->has('user') ? $this->Html->link($cruiseReview->user->username, ['controller' => 'Users', 'action' => 'view', $cruiseReview->user->id]) : '' ?></td>
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
