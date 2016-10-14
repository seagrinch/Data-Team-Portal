<h3>Assets</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('asset_uid') ?></th>
      <th><?= $this->Paginator->sort('type') ?></th>
      <th><?= $this->Paginator->sort('mobile') ?></th>
      <th><?= $this->Paginator->sort('description_of_equipment') ?></th>
      <th><?= $this->Paginator->sort('manufacturer') ?></th>
      <th><?= $this->Paginator->sort('model') ?></th>
      <th><?= $this->Paginator->sort('manufacturer_serial_no') ?></th>
      <th><?= $this->Paginator->sort('acquisition_date') ?></th>
      <th><?= $this->Paginator->sort('origional_cost') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($assets as $asset): ?>
    <tr>
      <td><?= $this->Html->link($asset->asset_uid, ['action' => 'view', $asset->asset_uid]) ?></td>
      <td><?= h($asset->type) ?></td>
      <td><?= h($asset->mobile) ?></td>
      <td><?= h($asset->description_of_equipment) ?></td>
      <td><?= h($asset->manufacturer) ?></td>
      <td><?= h($asset->model) ?></td>
      <td><?= h($asset->manufacturer_serial_no) ?></td>
      <td><?= h($asset->acquisition_date) ?></td>
      <td><?= $this->Number->currency($asset->original_cost) ?></td>
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
