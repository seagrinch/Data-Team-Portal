<?php $this->assign('title',$instrument->reference_designator)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></li>
  <li class="active"><?= h($instrument->name) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <!--
    <?php 
      $session = $this->request->session();
      if ($session->check('Auth.User')) { 
        echo $this->Html->link('Edit Instrument', ['action'=>'edit', $instrument->reference_designator], ['class'=>'btn btn-info']);
      }
    ?>
    -->
    <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'http://oceanobservatories.org/site/' . substr($instrument->reference_designator,0,8), 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
    <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'https://ooinet.oceanobservatories.org/plot/#' . $instrument->reference_designator, 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
  </div>
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>', 
      ['action' => 'view', $instrument->reference_designator],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
    <?php echo $this->Html->link('Report <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>', 
      ['action' => 'report', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>', 
      ['action' => 'stats-daily', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>', 
      ['action' => 'stats-monthly', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
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
<!--
      <dt><?= __('Default Stream') ?></dt>
      <dd><?= h($instrument->preferred_stream) ?></dd>
      <dt><?= __('Default Parameter') ?></dt>
      <dd><?= h($instrument->preferred_parameter) ?></dd>
-->
      <dt><?= __('Current Status') ?></dt>
      <dd><?php echo $this->element('instrument_status', ['status'=>$instrument->current_status]); ?></dd>
    </dl>

  </div>
  <div class="col-md-7">

    <dl class="dl-horizontal">
      <dt><?= __('Class') ?></dt>
      <dd><?= $this->Html->link($instrument_class->class, ['controller'=>'instrument_classes', 'action'=>'view', $instrument_class->class]) ?> (<?= h($instrument_class->name) ?>)</dd>
      <dt><?= __('Series') ?></dt>
      <dd><?= $this->html->link($instrument_model->class . '-' .$instrument_model->series, ['controller'=>'instrument_models', 'action'=>'view', $instrument_model->class, $instrument_model->series]) ?></dd>
      <dt><?= __('Science Discipline') ?></dt>
      <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>
      <dt><?= __('Make') ?></dt>
      <dd><?= h($instrument_model->make) ?></dd>
      <dt><?= __('Model') ?></dt>
      <dd><?= h($instrument_model->model) ?></dd>
    </dl>

  </div>
</div>
<dl class="dl-horizontal">
  <dt>M2M Example <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="You can add /times or /parameters to subset this list. You can also remove /metadata to get the list of available streams."></span></dt>
  <dd>
    <?php echo sprintf("https://ooinet.oceanobservatories.org/api/m2m/12576/sensor/inv/%s/%s/%s/metadata", 
      $instrument->node->site->reference_designator,
      substr($instrument->reference_designator,9,5),
      substr($instrument->reference_designator,15,12) ); ?>
  </dd>
</dl>


<!-- Stats Graph -->
<?php echo $this->element('availability_chart', [
  'deployments'=>$instrument->deployments, 
  'annotations'=>$instrument->annotations
  ]); ?>


<!-- Tabbed Navigation -->
<div>
  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams/Parameters</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments <?php if (count($instrument->deployments)) { ?><span class="badge"><?= count($instrument->deployments)?></span><?php } ?></a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes <?php if ($instrument->notes->count()) { ?><span class="badge"><?= $instrument->notes->count()?></span><?php } ?></a></li>
    <li role="presentation"><a href="#annotations" aria-controls="annotations" role="tab" data-toggle="tab">Annotations <?php if ($instrument->annotations->count()) { ?><span class="badge"><?= $instrument->annotations->count()?></span><?php } ?></a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="streams">
      <?php if (count($instrument->data_streams)>0): ?>
        <table class="table table-striped table-hover">
          <tr>
            <th>Method</th>
            <th>Data Stream</th>
            <th>Content</th>
            <th></th>
            <th>Type</th>
          </tr>
          <?php foreach ($instrument->data_streams as $s): ?>
          <tr>
            <td><?= h($s->method) ?></td>
            <td><?= $this->Html->link($s->stream_name, ['controller'=>'streams', 'action' => 'view', $s->stream_name]) ?></td>
            <td><?= h($s->stream->stream_content) ?></td>
            <td>
              <?= $this->Html->link('Report <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
                ['controller'=>'data-streams', 'action' => 'view', $s->id],
                ['class'=>'btn btn-default btn-xs','escape'=>false]) ?>
              <?= $this->Html->link('M2M <span class="glyphicon glyphicon-lamp" aria-hidden="true">', 
                  sprintf("https://ooinet.oceanobservatories.org/api/m2m/12576/sensor/inv/%s/%s/%s/%s/%s?beginDT=%s&endDT=%s&limit=1000", 
                    $instrument->node->site->reference_designator,
                    substr($instrument->reference_designator,9,5),
                    substr($instrument->reference_designator,15,12),
                    $s->method,
                    $s->stream_name,
                    date_create('1 day ago')->format('Y-m-d\TH:i:s.\0\0\0\Z'),
                    date_create('now')->format('Y-m-d\TH:i:s.\0\0\0\Z') ),
                  ['class'=>'btn btn-default btn-xs','escape'=>false]) ?>
              <?php
                if ($s->stream->stream_type=='Science') {
                  echo $this->Html->link('Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
                    ['controller'=>'data-streams', 'action' => 'stats-daily', $s->id],
                    ['class'=>'btn btn-default btn-xs','escape'=>false]);
                  //echo $this->Html->link('Plot <span class="glyphicon glyphicon-signal" aria-hidden="true">', 
                  //  ['controller'=>'data-streams', 'action' => 'plot', $s->id],
                  //  ['class'=>'btn btn-default btn-xs','escape'=>false]);
                } ?>
<!--
              <?= $this->Html->link('Parameters <span class="glyphicon glyphicon-list-alt" aria-hidden="true">', 
                '#',
                ['class'=>'btn btn-default btn-xs','escape'=>false, 'data-toggle'=>'modal', 'data-target'=>'#'.$s->id]) ?>
-->
              </td>
            <td><?= h($s->stream->stream_type) ?></td>
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
            <td><?= h($d->deployment_number) ?>
            <?= $this->Html->link('Review <span class="glyphicon glyphicon-check" aria-hidden="true">', 
              ['controller'=>'deployment-reviews', 'action' => 'view', $d->reference_designator, $d->deployment_number],
              ['class'=>'btn btn-default btn-xs','escape'=>false]) ?>
            </td>
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
        <?php echo $this->Html->link(__('New Note'), ['controller'=>'notes','action'=>'add',$instrument->reference_designator], ['class'=>'btn btn-primary']); ?>
      </p>

    </div>
    <div role="tabpanel" class="tab-pane" id="annotations">

      <?php echo $this->element('annotations_table', ['annotations'=>$instrument->annotations]); ?>

    </div>

  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->


<!-- Parameter modal -->
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
<!-- End Parameter modal -->


<?php $this->Html->scriptStart(['block' => true]); ?>  
  // Initialize Tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

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
