<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['controller'=>'instrument_classes','action' => 'index']) ?></li>
  <li><?= $this->Html->link($instrumentModel->class, ['controller'=>'instrument_classes','action' => 'view', $instrumentModel->class]) ?></li>
  <li class="active"><?= h($instrumentModel->class) ?>-<?= h($instrumentModel->series) ?></li>
</ol>

<h3>Instrument Model: <?= h($instrumentModel->class) ?>-<?= h($instrumentModel->series) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Class') ?></dt>
  <dd><?= h($instrumentModel->class) ?></dd>
  <dt><?= __('Series') ?></dt>
  <dd><?= h($instrumentModel->series) ?></dd>
  <dt><?= __('Name') ?></dt>
  <dd><?= h($instrumentModel->name) ?></dd>
  <dt><?= __('Make') ?></dt>
  <dd><?= h($instrumentModel->make) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($instrumentModel->model) ?></dd>
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($instrumentModel->id) ?></dd>
</dl>