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
    <?php foreach ($instrument_models as $instrument_model): ?>
    <tr>
      <td><?= $this->html->link($instrument_model->class . '-' .$instrument_model->series,
          ['action'=>'view',$instrument_model->class, $instrument_model->series]) ?> 
      <td><?= h($instrument_model->class) ?></td>
      <td><?= h($instrument_model->series) ?></td>
      <td><?= h($instrument_model->name) ?></td>
      <td><?= h($instrument_model->make) ?></td>
      <td><?= h($instrument_model->model) ?></td>
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
