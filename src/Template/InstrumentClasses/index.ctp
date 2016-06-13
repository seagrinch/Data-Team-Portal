<h3>Instrument Classes</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('class') ?></th>
      <th><?= $this->Paginator->sort('name') ?></th>
      <th><?= $this->Paginator->sort('primary_science_dicipline') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instrumentClasses as $instrumentClass): ?>
    <tr>
      <td><?= $this->html->link($instrumentClass->class,['action'=>'view',$instrumentClass->class]) ?> 
      <td><?= h($instrumentClass->name) ?></td>
      <td><?= h($instrumentClass->primary_science_dicipline) ?></td>
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
