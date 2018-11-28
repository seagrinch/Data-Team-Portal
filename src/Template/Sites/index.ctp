<h3>Sites</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('array_name') ?></th>
      <th><?= $this->Paginator->sort('name',['label'=>'Site Name']) ?></th>
      <th><?= $this->Paginator->sort('min_depth') ?></th>
      <th><?= $this->Paginator->sort('max_depth') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sites as $site): ?>
    <tr>
      <td><?= $this->html->link($site->reference_designator,['action'=>'view',$site->reference_designator]) ?> 
      <td><?= h($site->array_name) ?></td>
      <td><?= h($site->name) ?></td>
      <td><?= $this->Number->format($site->min_depth) ?></td>
      <td><?= $this->Number->format($site->max_depth) ?></td>
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
