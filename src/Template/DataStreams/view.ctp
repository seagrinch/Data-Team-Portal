<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li>...</li>
  <li><?= $this->html->link($dataStream->reference_designator,['controller'=>'instruments','action'=>'view',$dataStream->reference_designator]) ?></li>
  <li class="active"><?= h($dataStream->method) ?> / <?= h($dataStream->stream_name) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm " role="group" aria-label="...">
    <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'http://oceanobservatories.org/site/' . substr($dataStream->reference_designator,0,8), 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
    <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'https://ooinet.oceanobservatories.org/plot/#' . $dataStream->reference_designator, 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
  </div>
<!--
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Report <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['controller'=>'data-streams', 'action' => 'view', $dataStream->id],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
    <?php echo $this->Html->link('Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['controller'=>'data-streams', 'action' => 'stats-daily', $dataStream->id],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Plot <span class="glyphicon glyphicon-signal" aria-hidden="true">', 
      ['controller'=>'data-streams', 'action' => 'plot', $dataStream->id],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
-->
</div>

<h3>Data Stream Report</h3>

<div class="row">
  <div class="col-md-5">
    <dl class="dl-horizontal">
      <dt><?= __('Instrument Name') ?></dt>
      <dd><?= $dataStream->has('instrument') ? $dataStream->instrument->name : '' ?></dd>
      <dt><?= __('Reference Designator') ?></dt>
      <dd><?= $this->Html->link($dataStream->reference_designator, ['controller' => 'instruments', 'action' => 'view', $dataStream->reference_designator]) ?></dd>
      <dt><?= __('Method') ?></dt>
      <dd><?= h($dataStream->method) ?></dd>
      <dt><?= __('Stream') ?></dt>
      <dd><?= $this->Html->link($dataStream->stream_name, ['controller' => 'streams', 'action' => 'view', $dataStream->stream_name]) ?></dd>
    </dl>
  </div>
  <div class="col-md-7">
    <dl class="dl-horizontal">
      <dt><?= __('Stream Type') ?></dt>
      <dd><?= h($dataStream->stream->stream_type) ?></dd>
      <dt><?= __('Stream Content') ?></dt>
      <dd><?= h($dataStream->stream->stream_content) ?></dd>
      <dt><?= __('Uframe Route') ?></dt>
      <dd><?= h($dataStream->uframe_route) ?></dd>
      <dt><?= __('Driver') ?></dt>
      <dd><?= h($dataStream->driver) ?></dd>
      <dt><?= __('Parser') ?></dt>
      <dd><?= h($dataStream->parser) ?></dd>
    </dl>
  </div>
</div>


<!-- Stats Graph -->
<?php echo $this->element('availability_chart', [
  'deployments'=>$dataStream->instrument->deployments, 
  'annotations'=>$dataStream->annotations,
  'cassandra'=>$dataStream->cassandra
  ]); ?>


<!-- Tabbed Navigation -->
<div>
  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">    
    <li role="presentation" class="active"><a href="#annotations" aria-controls="annotations" role="tab" data-toggle="tab">Annotations <?php if ($dataStream->annotations->count()) { ?><span class="badge"><?= $dataStream->annotations->count()?></span><?php } ?></a></li>
    <li role="presentation"><a href="#parameters" aria-controls="parameters" role="tab" data-toggle="tab">Parameters</a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="annotations">
      
      <h3>Annotations</h3>
      <?php echo $this->element('annotations_table', ['annotations'=>$dataStream->annotations]); ?>
    
    </div>
    <div role="tabpanel" class="tab-pane" id="parameters">

      <h3>Parameters</h3>
      <?php if (count($dataStream->stream->parameters)>0): ?>
      <table class="table table-striped table-condensed">
        <thead>
          <tr>
            <th>Id</th>
            <th>Parameter</th>
            <th>Display Name</th>
            <th>Standard Name</th>
            <th>Unit</th>
            <th>Fill Value</th>
            <th>Precision</th>
            <th>Identifier</th>
            <th>Type</th>
            <th>Level</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($dataStream->stream->parameters as $p): ?>
          <tr>
            <td>PD<?= h($p->id) ?></td>
            <td><?= $this->Html->link($p->name, ['controller'=>'parameters', 'action' => 'view', $p->id]) ?> </td>
            <td><?= h($p->display_name) ?></td>
            <td><?= h($p->standard_name) ?></td>
            <td><?= h($p->unit) ?></td>
            <td><?= h($p->fill_value) ?></td>
            <td><?= h($p->precision) ?></td>
            <td><?= h($p->data_product_identifier) ?></td>
            <td><?= ($p->data_product_type ? $p->data_product_type : "") ?></td>
            <td><?= ($p->data_level>-1 ? "L".$p->data_level : "") ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>

    </div>

  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->
