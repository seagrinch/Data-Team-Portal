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

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($instrument->reference_designator) ?></dd>
  <dt><?= __('Start Depth') ?></dt>
  <dd><?= $this->Number->format($instrument->start_depth) ?></dd>
  <dt><?= __('End Depth') ?></dt>
  <dd><?= $this->Number->format($instrument->end_depth) ?></dd>
  <dt><?= __('Location') ?></dt>
  <dd><?= h($instrument->location) ?></dd>
  <dt><?= __('uFrame Status') ?></dt>
  <dd><?php if ($instrument->uframe_status=='1') { ?>
      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> OK
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
  <dt><?= __('Current Status') ?></dt>
  <dd><?php if ($instrument->current_status=='deployed') { ?>
      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> Deployed
    <?php } elseif ($instrument->current_status=='recovered') { ?>
      <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red;"></span> Recovered
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
</dl>

<div><!-- Tabbed Navigation -->

  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams/Parameters</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
    <li role="presentation"><a href="#instrument" aria-controls="instrument" role="tab" data-toggle="tab">Instrument Info</a></li>
    <li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a></li>
    <li role="presentation"><a href="#tests" aria-controls="stats" role="tab" data-toggle="tab">Tests</a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="streams">
      <?php if (count($instrument->data_streams)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Method</th>
            <th>Stream Name</th>
            <th>uFrame Route</th>
            <th>Driver</th>
            <th>Parser</th>
          </tr>
          <?php foreach ($instrument->data_streams as $s): ?>
          <tr>
            <td><?= h($s->method) ?></td>
            <td>
              <?= $this->Html->link($s->stream->name, ['controller'=>'streams', 'action' => 'view', $s->stream->name]) ?>
              <?php if (count($instrument->data_streams)>0): ?>
                <ul>
                <?php foreach ($s->stream->parameters as $p): ?>
                   <li><?= $this->Html->link($p->name, ['controller'=>'parameters', 'action' => 'view', $p->id]) ?></li>
                <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </td>
            <td><?= h($s->uframe_route) ?></td>
            <td><?= h($s->driver) ?></td>
            <td><?= h($s->parser) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No streams found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="deployments">

      <?php if (count($instrument->deployments)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Deployment Number</th>
            <th>Deployment Cruise</th>
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
    <div role="tabpanel" class="tab-pane active" id="notes">

      <?php echo $this->element('notes', ['notes'=>$instrument->notes]); ?>
      <p class="text-left"><?php echo $this->Html->link(__('Add a New Note'), ['controller'=>'notes','action'=>'add','instruments',$instrument->reference_designator], ['class'=>'btn btn-primary']); ?></p>

    </div>
    <div role="tabpanel" class="tab-pane" id="instrument">

      <dl class="dl-horizontal">
        <dt><?= __('Class') ?></dt>
        <dd><?= h($instrument_class->class) ?></dd>
        <dt><?= __('Series') ?></dt>
        <dd><?= h($instrument_model->series) ?></dd>
        <dt><?= __('Instrument Name') ?></dt>
        <dd><?= h($instrument_class->name) ?></dd>
        <dt><?= __('Science Discipline') ?></dt>
        <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>
        <dt><?= __('Description') ?></dt>
        <dd><?= h($instrument_class->description) ?></dd>
        <dt><?= __('Make') ?></dt>
        <dd><?= h($instrument_model->make) ?></dd>
        <dt><?= __('Model') ?></dt>
        <dd><?= h($instrument_model->model) ?></dd>
      </dl>      

    </div>
    <div role="tabpanel" class="tab-pane" id="stats">

      <?php if (count($instrument->monthly_stats)>0): ?>


<?php $this->Html->css('https://fonts.googleapis.com/css?family=Muli',['block'=>true]); ?>
<?php $this->Html->css('/visavail/css/visavail.css',['block'=>true]); ?>
<?php $this->Html->css('/font-awesome/css/font-awesome.min.css',['block'=>true]); ?>
<?php $this->Html->script('/moment/moment-with-locales.min.js',['block'=>true]); ?>
<?php $this->Html->script('/d3/d3.min.js',['block'=>true]); ?>
<?php $this->Html->script('/visavail/js/visavail.js',['block'=>true]); ?>

<?php 
  $months=[];
  foreach ($instrument->monthly_stats as $s) {
    if (in_array(strtolower($s->operational_status), array_map('strtolower', ['Operational','Pending','Failed']))) {
      $months['operational_status'][] = [
        $this->Time->i18nFormat($s->month,'yyyy-MM-dd'), 
        (in_array(strtolower($s->operational_status), array_map('strtolower', ['Operational','Pending'])) ? 1 : 0),
        $this->Time->i18nFormat($s->month->addMonth(1),'yyyy-MM-dd')
      ];
      $months['cassandra_ts'][] = [
        $this->Time->i18nFormat($s->month,'yyyy-MM-dd'), 
        (($s->cassandra_ts>=10) ? 1 : 0), 
        $this->Time->i18nFormat($s->month->addMonth(1),'yyyy-MM-dd')
      ];
      $months['cassandra_rec'][] = [
        $this->Time->i18nFormat($s->month,'yyyy-MM-dd'), 
        (($s->cassandra_rec>=10) ? 1 : 0), 
        $this->Time->i18nFormat($s->month->addMonth(1),'yyyy-MM-dd')
      ];
    }
  }
/*
  echo '<pre>';
  print_r($months);
  echo '</pre>';
*/
?>

<?php $this->Html->scriptStart(['block' => true]); ?>
  var stats_data = <?php echo json_encode($months);?>;
  
  moment.locale("en");
    var dataset=[];
    if (stats_data['operational_status'].length>0) {
      dataset.push({
        "measure": "Op. Status",
        "interval_s": 30 * 24 * 60 * 60,
        "data": stats_data['operational_status'],
      })
    };
    if (stats_data['cassandra_ts'].length>0) {
      dataset.push({
        "measure": "Cass. Tel/Stream",
        "interval_s": 30 * 24 * 60 * 60,
        "data": stats_data['cassandra_ts'],
      })
    };
    if (stats_data['cassandra_rec'].length>0) {
      dataset.push({
        "measure": "Cass. Recovered",
        "interval_s": 30 * 24 * 60 * 60,
        "data": stats_data['cassandra_rec'],
      })
    };

    var chart = visavailChart().width(800); // define width of chart in px

    d3.select("#example")
            .datum(dataset)
            .call(chart);

<?php $this->Html->scriptEnd(); ?>

<p id="example"><!-- Visavail.js chart will be inserted here --></p>

        <table class="table table-striped">
          <tr>
            <th>Month</th>
<!--             <th>Deployment Status</th> -->
            <th>Cass. Tel/Stream</th>
            <th>Cass. Recovered</th>
            <th>Op. Status</th>
<!--             <th>Reviewed Status</th> -->
          </tr>
          <?php foreach ($instrument->monthly_stats as $s): ?>
          <tr>
            <td><?= $this->Time->i18nFormat($s->month,'MMMM, yyyy') ?></td>
<!--             <td><?= h($s->deployment_status) ?></td> -->
            <td><?= h($s->cassandra_ts) ?></td>
            <td><?= h($s->cassandra_rec) ?></td>
            <td><?= h($s->operational_status) ?></td>
<!--             <td><?= h($s->reviewed_status) ?></td> -->
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No stats found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="tests">

      <?php if (count($instrument->test_runs)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Deployment</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Created</th>
          </tr>
          <?php foreach ($instrument->test_runs as $testRun): ?>
          <tr>
            <td><?= h($testRun->id) ?></td>
            <td><?= $this->Html->link($testRun->name, ['controller'=>'test-runs', 'action' => 'view', $testRun->id]) ?></td>
            <td><?= h($testRun->deployment) ?></td>
            <td><?= h($testRun->start_date) ?></td>
            <td><?= h($testRun->end_date) ?></td>
            <td><?= h($testRun->status) ?></td>
            <td><?= $this->Time->timeAgoInWords($testRun->created) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No tests found</p>
      <?php endif; ?>
      <p class="text-left"><?php echo $this->Html->link(__('Add a Test Run'), ['controller'=>'test-runs', 'action'=>'add', $instrument->reference_designator], ['class'=>'btn btn-primary']); ?></p>

    </div>
  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->

<?php $this->Html->scriptStart(['block' => true]); ?>
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
  } 
  
  // Change hash for page-reload
  $('.nav-tabs a').on('shown.bs.tab', function (e) {
      window.location.hash = e.target.hash;
     window.scrollTo(0, 0);
  })
<?php $this->Html->scriptEnd(); ?>

<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($instrument);
*/
?>
