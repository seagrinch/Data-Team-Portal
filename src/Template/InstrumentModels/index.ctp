<h3>Instrument Models</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th></th>
      <th><?= $this->Paginator->sort('class') ?></th>
      <th><?= $this->Paginator->sort('series') ?></th>
      <th><?= $this->Paginator->sort('name') ?></th>
      <th><?= $this->Paginator->sort('make') ?></th>
      <th><?= $this->Paginator->sort('model') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instrumentModels as $instrumentModel): ?>
    <tr>
      <td><?= $this->html->link($instrumentModel->class . '-' .$instrumentModel->series,
          ['action'=>'view',$instrumentModel->class, $instrumentModel->series]) ?> 
      <td><?= h($instrumentModel->class) ?></td>
      <td><?= h($instrumentModel->series) ?></td>
      <td><?= h($instrumentModel->name) ?></td>
      <td><?= h($instrumentModel->make) ?></td>
      <td><?= h($instrumentModel->model) ?></td>
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
