<h3>Assets</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('ooi_barcode') ?></th>
      <th><?= $this->Paginator->sort('quant') ?></th>
      <th><?= $this->Paginator->sort('manufacturer') ?></th>
      <th><?= $this->Paginator->sort('model') ?></th>
      <th><?= $this->Paginator->sort('manufacturer_serial_no') ?></th>
      <th><?= $this->Paginator->sort('source_of_the_equipment') ?></th>
      <th><?= $this->Paginator->sort('whether_title') ?></th>
      <th><?= $this->Paginator->sort('location') ?></th>
      <th><?= $this->Paginator->sort('room_number') ?></th>
      <th><?= $this->Paginator->sort('condition') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($assets as $asset): ?>
    <tr>
      <td><?= $this->Html->link($asset->ooi_barcode, ['action' => 'view', $asset->ooi_barcode]) ?></td>
      <td><?= $this->Number->format($asset->quant) ?></td>
      <td><?= h($asset->manufacturer) ?></td>
      <td><?= h($asset->model) ?></td>
      <td><?= h($asset->manufacturer_serial_no) ?></td>
      <td><?= h($asset->source_of_the_equipment) ?></td>
      <td><?= h($asset->whether_title) ?></td>
      <td><?= h($asset->location) ?></td>
      <td><?= h($asset->room_number) ?></td>
      <td><?= h($asset->condition) ?></td>
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
