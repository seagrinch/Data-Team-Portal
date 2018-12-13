<?php $this->assign('title',$instrument_class->class)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($instrument_class->class) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit', ['action'=>'edit', $instrument_class->class], ['class'=>'btn btn-info']);
    }
  ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooinet.oceanobservatories.org/data_access/?search=' . $instrument_class->class, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3>Instrument Class: <?= h($instrument_class->class) ?></h3>

<div class="row">
  <div class="col-md-6">

    <dl class="dl-horizontal">
      <dt><?= __('Instrument Name') ?></dt>
      <dd><?= h($instrument_class->name) ?></dd>
      <dt><?= __('Science Discipline') ?></dt>
      <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>
      <dt><?= __('Description') ?></dt>
      <dd><?= $this->Text->autoParagraph(h($instrument_class->description)); ?></dd>
    </dl>

  </div>
  <div class="col-md-6">
    <p><strong>Website Info</strong></p>
    <?php
      $parser = new \Netcarver\Textile\Parser();
      echo $parser->textileThis($instrument_class->website_info);
    ?>
  </div>
</div>

<hr>

<h4>Related Instrument Series</h4>
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
    <?php foreach ($instrument_class->instrument_models as $instrument_model): ?>
    <tr>
      <td><?= $this->html->link($instrument_model->class . '-' .$instrument_model->series,
          ['controller'=>'instrument_models', 'action'=>'view', $instrument_model->class, $instrument_model->series]) ?> 
      <td><?= h($instrument_model->class) ?></td>
      <td><?= h($instrument_model->series) ?></td>
      <td><?= h($instrument_model->name) ?></td>
      <td><?= h($instrument_model->make) ?></td>
      <td><?= h($instrument_model->model) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
