<h3>Stream Reviews</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('deployment') ?></th>
      <th><?= $this->Paginator->sort('preferred_method') ?></th>
      <th><?= $this->Paginator->sort('stream') ?></th>
      <th><?= $this->Paginator->sort('modified') ?></th>
      <th><?= $this->Paginator->sort('status') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($reviews as $review): ?>
    <tr>
      <td><?= $this->html->link($review->reference_designator,['controller'=>'instruments','action'=>'report',$review->reference_designator]) ?> 
      <td><?= h($review->deployment) ?></td>
      <td><?= h($review->preferred_method) ?></td>
      <td><?= h($review->stream) ?></td>
      <td><?= h($review->modified) ?></td>
      <td><?= h($review->status) ?></td>
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
  <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}. Showing records {{start}} to {{end}} out of {{count}} total.') ?></p>
</div>
