<h3>Cruises</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('cuid','Cruise ID'); ?></th>
            <th><?= $this->Paginator->sort('ship_name'); ?></th>
            <th><?= $this->Paginator->sort('cruise_start_date'); ?></th>
            <th><?= $this->Paginator->sort('cruise_end_date'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cruises as $cruise): ?>
        <tr>
            <td><?= $this->Html->link($cruise->cuid,['action'=>'view',$cruise->cuid]) ?></td>
            <td><?= h($cruise->ship_name) ?></td>
            <td><?= h($cruise->cruise_start_date) ?></td>
            <td><?= h($cruise->cruise_end_date) ?></td>
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
