<?php $this->assign('title',$instrument_model->class.'-'.$instrument_model->series)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['controller'=>'instrument_classes','action' => 'index']) ?></li>
  <li><?= $this->Html->link($instrument_model->class, ['controller'=>'instrument_classes','action' => 'view', $instrument_model->class]) ?></li>
  <li class="active"><?= h($instrument_model->class) ?>-<?= h($instrument_model->series) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit', ['action'=>'edit', $instrument_model->class, $instrument_model->series], ['class'=>'btn btn-info']);
    }
  ?>
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'http://oceanobservatories.org/instrument-series/' . $instrument_model->class . $instrument_model->series, ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooinet.oceanobservatories.org/data_access/?search=' . $instrument_model->class . $instrument_model->series, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3>Instrument Series: <?= h($instrument_model->class) . '-' . $instrument_model->series ?></h3>

<div class="row">
  <div class="col-md-6">

    <dl class="dl-horizontal">
      <dt><?= __('Instrument Name') ?></dt>
      <dd><?= h($instrument_model->name) ?></dd>
      <dt><?= __('Science Discipline') ?></dt>
      <dd><?= h($instrument_model->instrument_class->primary_science_dicipline) ?></dd>
      <dt><?= __('Class Description') ?></dt>
      <dd><?= $this->Text->autoParagraph(h($instrument_model->instrument_class->description)); ?></dd>
      <dt><?= __('Series Description') ?></dt>
      <dd><?= $this->Text->autoParagraph(h($instrument_model->description)); ?></dd>
      <dt><?= __('Make') ?></dt>
      <dd><?= h($instrument_model->make) ?></dd>
      <dt><?= __('Model') ?></dt>
      <dd><?= h($instrument_model->model) ?></dd>
    </dl>

  </div>
  <div class="col-md-6">
    <p><strong>Website Info</strong></p>
    <?php
      $parser = new \Netcarver\Textile\Parser();
      echo $parser->textileThis($instrument_model->website_info);
    ?>
  </div>
</div>

<hr>

<h4>Deployed Instruments</h4>
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
      <td><?= $this->html->link($instrument->reference_designator,['controller'=>'instruments', 'action'=>'view', $instrument->reference_designator, '#'=>'instrument']) ?> 
      <td><?= h($instrument->node->site->name) ?></td>
      <td><?= h($instrument->node->name) ?></td>
      <td><?= h($instrument->name) ?></td>
      <td><?= $this->Number->format($instrument->start_depth) ?></td>
      <td><?= $this->Number->format($instrument->end_depth) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
