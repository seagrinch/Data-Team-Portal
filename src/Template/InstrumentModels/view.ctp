<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['controller'=>'instrument_classes','action' => 'index']) ?></li>
  <li><?= $this->Html->link($instrumentModel->class, ['controller'=>'instrument_classes','action' => 'view', $instrumentModel->class]) ?></li>
  <li class="active"><?= h($instrumentModel->class) ?>-<?= h($instrumentModel->series) ?></li>
</ol>

<h3>Instrument Model: <?= h($instrumentModel->class) ?>-<?= h($instrumentModel->series) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Instrument Name') ?></dt>
  <dd><?= h($instrumentModel->name) ?></dd>
  <dt><?= __('Science Discipline') ?></dt>
  <dd><?= h($instrumentModel->instrument_class->primary_science_dicipline) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($instrumentModel->instrument_class->description)); ?></dd>
  <dt><?= __('Make') ?></dt>
  <dd><?= h($instrumentModel->make) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($instrumentModel->model) ?></dd>
</dl>


<h3>Deployed Instruments</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th>Reference Designator</th>
      <th>Site Name</th>
      <th>Node Name</th>
      <th>Instrument Name</th>
      <th>Start Depth</th>
      <th>End Depth</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instruments as $instrument): ?>
    <tr>
      <td><?= $this->html->link($instrument->reference_designator,['action'=>'view',$instrument->reference_designator]) ?> 
      <td><?= h($instrument->node->site->name) ?></td>
      <td><?= h($instrument->node->name) ?></td>
      <td><?= h($instrument->name) ?></td>
      <td><?= $this->Number->format($instrument->start_depth) ?></td>
      <td><?= $this->Number->format($instrument->end_depth) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
