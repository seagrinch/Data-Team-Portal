<h3>Instruments</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('region_rd') ?></th>
      <th><?= $this->Paginator->sort('site_rd') ?></th>
      <th><?= $this->Paginator->sort('node_rd') ?></th>
      <th><?= $this->Paginator->sort('name') ?></th>
      <th><?= $this->Paginator->sort('start_depth') ?></th>
      <th><?= $this->Paginator->sort('end_depth') ?></th>
      <th><?= $this->Paginator->sort('location') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instruments as $instrument): ?>
    <tr>
      <td><?= $this->html->link($instrument->reference_designator,['action'=>'view',$instrument->reference_designator]) ?> 
      <td><?= h($instrument->region_rd) ?></td>
      <td><?= h($instrument->site_rd) ?></td>
      <td><?= h($instrument->node_rd) ?></td>
      <td><?= h($instrument->name) ?></td>
      <td><?= $this->Number->format($instrument->start_depth) ?></td>
      <td><?= $this->Number->format($instrument->end_depth) ?></td>
      <td><?= h($instrument->location) ?></td>
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
