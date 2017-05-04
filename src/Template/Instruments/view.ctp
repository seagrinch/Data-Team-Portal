<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></li>
  <li class="active"><?= h($instrument->name) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Instrument', ['action'=>'edit', $instrument->reference_designator], ['class'=>'btn btn-info']);
    }
  ?>
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'http://oceanobservatories.org/site/' . substr($instrument->reference_designator,0,8), ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooinet.oceanobservatories.org/plot/#' . $instrument->reference_designator, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3><?= h($instrument->name) ?></h3>

<div class="row">
  <div class="col-md-5">

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($instrument->reference_designator) ?></dd>
  <dt><?= __('Start Depth') ?></dt>
  <dd><?= $this->Number->format($instrument->start_depth) ?></dd>
  <dt><?= __('End Depth') ?></dt>
  <dd><?= $this->Number->format($instrument->end_depth) ?></dd>
  <dt><?= __('Location') ?></dt>
  <dd><?= h($instrument->location) ?></dd>
  <dt><?= __('Current Status') ?></dt>
  <dd><?php if ($instrument->current_status=='deployed') { ?>
      <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:green;"></span> Deployed
    <?php } elseif ($instrument->current_status=='recovered') { ?>
      <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color:gray;"></span> Recovered
    <?php } elseif ($instrument->current_status=='lost') { ?>
      <span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style="color:red;"></span> Lost
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
</dl>

  </div>
  <div class="col-md-7">

    <dl class="dl-horizontal">
      <dt><?= __('Class') ?></dt>
      <dd><?= $this->Html->link($instrument_class->class, ['controller'=>'instrument_classes', 'action'=>'view', $instrument_class->class]) ?></dd>
      <dt><?= __('Series') ?></dt>
      <dd><?= $this->html->link($instrument_model->class . '-' .$instrument_model->series, ['controller'=>'instrument_models', 'action'=>'view', $instrument_model->class, $instrument_model->series]) ?></dd>
      <dt><?= __('Instrument Name') ?></dt>
      <dd><?= h($instrument_class->name) ?></dd>
      <dt><?= __('Science Discipline') ?></dt>
      <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>
<!--
      <dt><?= __('Description') ?></dt>
      <dd><?= h($instrument_class->description) ?></dd>
-->
      <dt><?= __('Make') ?></dt>
      <dd><?= h($instrument_model->make) ?></dd>
      <dt><?= __('Model') ?></dt>
      <dd><?= h($instrument_model->model) ?></dd>
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
  if (count($instrument->deployments)>0) {
    $data_deployments = [
      'measure'=>'Deployments',
      'categories'=>[
        'Deployed'=>['color'=>'#00be70']
      ]
    ];
    foreach ($instrument->deployments as $d) {
      $data_deployments['data'][] = [
        $this->Time->i18nFormat($d->start_date,'yyyy-MM-dd HH:mm:ss'), 
        'Deployed', 
        ($d->stop_date) ? $this->Time->i18nFormat($d->stop_date,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
    }
    array_push($data,$data_deployments);
  }
  if ($instrument->annotations->count()>0) {
    $data_annotations = [
      'measure'=>'Annotations',
      'categories'=>[
        'PENDING_INGEST'=>['color'=>'blue'],
        'NOT_OPERATIONAL'=>['color'=>'red'],
        'NOT_AVAILABLE'=>['color'=>'red'],
        ''=>['color'=>'gray'],
      ]
    ];
    foreach ($instrument->annotations as $a) {
      if ($a->start_datetime) {
        $data_annotations['data'][] = [
          $this->Time->i18nFormat($a->start_datetime,'yyyy-MM-dd HH:mm:ss'), 
          $a->status, 
          ($a->end_datetime) ? $this->Time->i18nFormat($a->end_datetime,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
      }
    }
    if(isset($data_annotations['data'])) {
      array_push($data,$data_annotations);    
    }
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
    <li role="presentation" class="active"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments <?php if (count($instrument->deployments)) { ?><span class="badge"><?= count($instrument->deployments)?></span><?php } ?></a></li>
    <li role="presentation"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams/Parameters</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes <?php if ($instrument->notes->count()) { ?><span class="badge"><?= $instrument->notes->count()?></span><?php } ?></a></li>
    <li role="presentation"><a href="#annotations" aria-controls="annotations" role="tab" data-toggle="tab">Annotations <?php if ($instrument->annotations->count()) { ?><span class="badge"><?= $instrument->annotations->count()?></span><?php } ?></a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="streams">
      <?php if (count($instrument->data_streams)>0): ?>
        <table class="table table-striped table-hover">
          <tr>
            <th>Method</th>
            <th>Data Stream</th>
            <th></th>
          </tr>
          <?php foreach ($instrument->data_streams as $s): ?>
          <tr>
            <td><?= h($s->method) ?></td>
            <td><?= $this->Html->link($s->stream_name, ['controller'=>'data-streams', 'action' => 'view', $s->id]) ?>
            </td>
            <td>
              <?= $this->Html->link('Stream <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
                ['controller'=>'streams', 'action' => 'view', $s->stream_name],
                ['class'=>'btn btn-default btn-xs','escape'=>false]) ?>
              <?= $this->Html->link('Parameters <span class="glyphicon glyphicon-list-alt" aria-hidden="true">', 
                '#',
                ['class'=>'btn btn-default btn-xs','escape'=>false, 'data-toggle'=>'modal', 'data-target'=>'#'.$s->id]) ?>
              </td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No streams found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane active" id="deployments">

      <?php if (count($instrument->deployments)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Deployment</th>
            <th>Cruise</th>
            <th>Start Date</th>
            <th>Stop Date</th>
            <th>Mooring Asset</th>
            <th>Node Asset</th>
            <th>Sensor Asset</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Deployment Depth</th>
            <th>Water Depth</th>
          </tr>
          <?php foreach ($instrument->deployments as $d): ?>
          <tr>
            <td><?= h($d->deployment_number) ?></td>
            <td><?= $this->Html->link($d->deploy_cuid, ['controller'=>'cruises', 'action' => 'view', $d->deploy_cuid]) ?></td>
            <td><?= $this->Time->format($d->start_date, 'MM/dd/yyyy') ?></td>
            <td><?= $this->Time->format($d->stop_date, 'MM/dd/yyyy') ?></td>
            <td><?= $this->Html->link($d->mooring_uid, ['controller'=>'assets', 'action' => 'view', $d->mooring_uid]) ?></td>
            <td><?= $this->Html->link($d->node_uid, ['controller'=>'assets', 'action' => 'view', $d->node_uid]) ?></td>
            <td><?= $this->Html->link($d->sensor_uid, ['controller'=>'assets', 'action' => 'view', $d->sensor_uid]) ?></td>
            <td><?= h($d->latitude) ?></td>
            <td><?= h($d->longitude) ?></td>
            <td><?= h($d->deployment_depth) ?></td>
            <td><?= h($d->water_depth) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No deployments found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="notes">

      <?php echo $this->element('notes_table', ['notes'=>$instrument->notes]); ?>
      <p class="text-left">
        <?php echo $this->Html->link(__('New Note'), ['controller'=>'annotations','action'=>'add',$instrument->reference_designator], ['class'=>'btn btn-primary']); ?>
      </p>

    </div>
    <div role="tabpanel" class="tab-pane" id="annotations">

      <?php echo $this->element('annotations_table', ['annotations'=>$instrument->annotations]); ?>

    </div>

  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->



<!-- Parameter Modals -->
<?php if (count($instrument->data_streams)>0): ?>
  <?php foreach ($instrument->data_streams as $s): ?>
    <div class="modal fade" id="<?= h($s->id)?>" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?= h($s->stream->name) ?></h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped table-condensed">
              <thead>
              <tr>
                <th>Parameter</th>
                <th>Data Product Type</th>
                <th>Level</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($s->stream->parameters as $p): ?>
              <tr>
                <td>PD<?= $p->id ?>
                <?= $this->Html->link($p->name, ['controller'=>'parameters', 'action' => 'view', $p->id]) ?> </td>
                <td><?= ($p->data_product_type ? $p->data_product_type : "") ?></td>
                <td><?= ($p->data_level>-1 ? "L".$p->data_level : "") ?></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
<!--
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
-->
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


<?php $this->Html->scriptStart(['block' => true]); ?>  
  // Javascript to enable link to tab
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href="#'+url.split('#')[1]+'"]').tab('show') ;
  } 
  
  // With HTML5 history API, we can easily prevent scrolling!
  $('.nav-tabs a').on('shown.bs.tab', function (e) {
      if(history.pushState) {
          history.pushState(null, null, e.target.hash); 
      } else {
          window.location.hash = e.target.hash; //Polyfill for old browsers
      }
  })
<?php $this->Html->scriptEnd(); ?>

<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($instrument);
*/
?>
