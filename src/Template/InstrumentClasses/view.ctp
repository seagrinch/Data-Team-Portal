<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($instrumentClass->class) ?></li>
</ol>

<h3>Instrument Class: <?= h($instrumentClass->class) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Instrument Name') ?></dt>
  <dd><?= h($instrumentClass->name) ?></dd>
  <dt><?= __('Science Discipline') ?></dt>
  <dd><?= h($instrumentClass->primary_science_dicipline) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($instrumentClass->description)); ?></dd>
</dl>


<h3>Instrument Models</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th></th>
      <th>Class</th>
      <th>Series</th>
      <th>Name</th>
      <th>Make</th>
      <th>Model</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instrumentClass->instrument_models as $instrumentModel): ?>
    <tr>
      <td><?= $this->html->link($instrumentModel->class . '-' .$instrumentModel->series,
          ['controller'=>'instrument_models', 'action'=>'view', $instrumentModel->class, $instrumentModel->series]) ?> 
      <td><?= h($instrumentModel->class) ?></td>
      <td><?= h($instrumentModel->series) ?></td>
      <td><?= h($instrumentModel->name) ?></td>
      <td><?= h($instrumentModel->make) ?></td>
      <td><?= h($instrumentModel->model) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
