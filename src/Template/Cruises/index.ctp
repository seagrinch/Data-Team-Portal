<h3>Cruises</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('cuid','Cruise ID') ?></th>
            <th><?= $this->Paginator->sort('ship_name') ?></th>
            <th><?= $this->Paginator->sort('notes') ?></th>
            <th><?= $this->Paginator->sort('cruise_start_date', 'Start Date') ?></th>
            <th><?= $this->Paginator->sort('cruise_end_date','End Date') ?></th>
            <th><?= $this->Paginator->sort('CruiseReviews.status', 'Review Status') ?></th>
            <th><?= $this->Paginator->sort('CruiseReviews.modified','Last Reviewed') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cruises as $cruise): ?>
        <tr>
            <td><?= $this->Html->link($cruise->cuid,['action'=>'view',$cruise->cuid]) ?></td>
            <td><?= h($cruise->ship_name) ?></td>
            <td><?= h($cruise->notes) ?></td>
            <td><?= $this->Time->format($cruise->cruise_start_date, 'MM/dd/yyyy') ?></td>
            <td><?= $this->Time->format($cruise->cruise_end_date, 'MM/dd/yyyy') ?></td>
            <td><?php 
                if (isset($cruise->cruise_review->status)) {
                  $txt = h($cruise->cruise_review->status);
                } else {
                  $txt = 'New';
                }
              echo $this->Html->link($txt,
                ['controller'=>'cruise-reviews', 'action'=>'view', $cruise->cuid], 
                ['class'=>'']);
            ?></td>
            <td><?php
              if (isset($cruise->cruise_review->status)) {
                echo $this->Time->timeAgoInWords($cruise->cruise_review->modified);
              }
            ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('first')) ?>
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
    <?= $this->Paginator->last(__('last') . ' >>') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
