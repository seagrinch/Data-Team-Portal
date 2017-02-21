<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li>...</li>
  <li><?= $this->html->link($dataStream->reference_designator,['controller'=>'instruments','action'=>'view',$dataStream->reference_designator]) ?></li>
  <li class="active"><?= h($dataStream->method) ?> / <?= h($dataStream->stream_name) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'http://oceanobservatories.org/site/' . substr($dataStream->reference_designator,0,8), ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooinet.oceanobservatories.org/plot/#' . $dataStream->reference_designator, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3>Data Stream Report</h3>

<div class="row">
  <div class="col-md-5">
    <dl class="dl-horizontal">
      <dt><?= __('Instrument Name') ?></dt>
      <dd><?= $dataStream->has('instrument') ? $this->Html->link($dataStream->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $dataStream->instrument->reference_designator]) : '' ?></dd>
      <dt><?= __('Reference Designator') ?></dt>
      <dd><?= h($dataStream->reference_designator) ?></dd>
      <dt><?= __('Method') ?></dt>
      <dd><?= h($dataStream->method) ?></dd>
      <dt><?= __('Stream') ?></dt>
      <dd><?= $dataStream->has('stream') ? $this->Html->link($dataStream->stream->name, ['controller' => 'Streams', 'action' => 'view', $dataStream->stream->id]) : '' ?></dd>
    </dl>
  </div>
  <div class="col-md-7">
    <dl class="dl-horizontal">
      <dt><?= __('Uframe Route') ?></dt>
      <dd><?= h($dataStream->uframe_route) ?></dd>
      <dt><?= __('Driver') ?></dt>
      <dd><?= h($dataStream->driver) ?></dd>
      <dt><?= __('Parser') ?></dt>
      <dd><?= h($dataStream->parser) ?></dd>
      <dt><?= __('Instrument Type') ?></dt>
      <dd><?= h($dataStream->instrument_type) ?></dd>
    </dl>
  </div>
</div>


<!-- Stats Graph -->
<?php $this->Html->css('https://fonts.googleapis.com/css?family=Muli',['block'=>true]); ?>
<?php $this->Html->css('/visavail/css/visavail.css',['block'=>true]); ?>
<?php $this->Html->css('/font-awesome/css/font-awesome.min.css',['block'=>true]); ?>
<?php $this->Html->script('/moment/moment-with-locales.min.js',['block'=>true]); ?>
<?php $this->Html->script('/d3/d3.min.js',['block'=>true]); ?>
<?php $this->Html->script('/visavail/js/visavail.js',['block'=>true]); ?>
<?php 
  $data=[];
  if (count($dataStream->instrument->deployments)>0) {
    $data_deployments = [
      'measure'=>'Deployments',
      'categories'=>[
        'Deployed'=>['color'=>'#00be70']
      ]
    ];
    foreach ($dataStream->instrument->deployments as $d) {
      $data_deployments['data'][] = [
        $this->Time->i18nFormat($d->start_date,'yyyy-MM-dd HH:mm:ss'), 
        'Deployed', 
        ($d->stop_date) ? $this->Time->i18nFormat($d->stop_date,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
    }
    array_push($data,$data_deployments);
  }
  if (count($dataStream->cassandra)>0) {
    $data_annotations = [
      'measure'=>'Cassandra',
      'categories'=>[
        'Available'=>['color'=>'#295ea4']
      ]
    ];
    foreach ($dataStream->cassandra as $c) {
      $data_annotations['data'][] = [
        date('Y-m-d H:i:s', strtotime($c->beginTime)), 
        'Available', 
        ($c->endTime) ? date('Y-m-d H:i:s', strtotime($c->endTime)) : date("Y-m-d H:i:s")];
    }
    array_push($data,$data_annotations);
  }
  if ($dataStream->annotations->count()>0) {
    $data_annotations = [
      'measure'=>'Annotations',
      'categories'=>[
        'Not Operational'=>['color'=>'gray'],
        'Unavailable'=>['color'=>'#295ea4'],
        'Pending'=>['color'=>'#ffcb4f'],
        'Suspect'=>['color'=>'#fa5a5a'],
        'Available'=>['color'=>'#00be70']
      ]
    ];
    foreach ($dataStream->annotations as $a) {
      if ($a->start_date) {
        $data_annotations['data'][] = [
          $this->Time->i18nFormat($a->start_date,'yyyy-MM-dd HH:mm:ss'), 
          $a->status, 
          ($a->end_date) ? $this->Time->i18nFormat($a->end_date,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
      }
    }
    array_push($data,$data_annotations);
  }
?>
<?php $this->Html->scriptStart(['block' => true]); ?>
  var dataset = <?php echo json_encode($data);?>;
  moment.locale("en");
  var chart = visavailChart().width(800); // define width of chart in px
  d3.select("#example")
    .datum(dataset)
    .call(chart);
<?php $this->Html->scriptEnd(); ?>
<div id="example" class="well"><!-- Visavail.js chart will be inserted here --></div>

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
<p class="text-left">
  <?php echo $this->Html->link(__('New Annotation'), [
    'controller'=>'annotations',
    'action'=>'add',
    'annotation',
    $dataStream->reference_designator, 
    '?'=>[
      'method'=>$dataStream->method,
      'stream'=>$dataStream->stream_name
    ]], ['class'=>'btn btn-primary']); ?>
</p>

    </div>
    <div role="tabpanel" class="tab-pane" id="parameters">

<h3>Parameters</h3>
<?php if (count($dataStream->stream->parameters)>0): ?>
<table class="table table-striped table-condensed">
  <thead>
    <tr>
      <th>Parameter</th>
      <th>Data Product Type</th>
      <th>Level</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($dataStream->stream->parameters as $p): ?>
    <tr>
      <td><?= $this->Html->link($p->name, ['controller'=>'parameters', 'action' => 'view', $p->id]) ?> </td>
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
