<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'view',$site->region->reference_designator]) ?></li>
  <li class="active"><?= h($site->name) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Site', ['action'=>'edit', $site->reference_designator], ['class'=>'btn btn-info']);
    }
  ?>
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'http://oceanobservatories.org/site/' . substr($site->reference_designator,0,8), ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooiui.oceanobservatories.org/plot/#' . $site->reference_designator, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3><?= h($site->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($site->reference_designator) ?></dd>
  <dt><?= __('Array Name') ?></dt>
  <dd><?= $site->array_name ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $site->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($site->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($site->longitude) ?></dd>
  <dt><?= __('Min Depth') ?></dt>
  <dd><?= $this->Number->format($site->min_depth) ?></dd>
  <dt><?= __('Max Depth') ?></dt>
  <dd><?= $this->Number->format($site->max_depth) ?></dd>
  <dt><?= __('Current Status') ?></dt>
  <dd><?php if ($site->current_status=='deployed') { ?>
      <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color:green;"></span> Deployed
    <?php } elseif ($site->current_status=='recovered') { ?>
      <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color:gray;"></span> Recovered
    <?php } elseif ($site->current_status=='lost') { ?>
      <span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style="color:red;"></span> Lost
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
</dl>


<div><!-- Tabbed Navigation -->

  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#instruments" aria-controls="instruments" role="tab" data-toggle="tab">Nodes & Instruments</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments <?php if (count($site->deployments)) { ?><span class="badge"><?= count($site->deployments)?></span><?php } ?></a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes <?php if ($site->notes->count()) { ?><span class="badge"><?= $site->notes->count()?></span><?php } ?></a></li>
    <li role="presentation"><a href="#annotations" aria-controls="issues" role="tab" data-toggle="tab">Annotations <?php if ($site->annotations->count()) { ?><span class="badge"><?= $site->annotations->count()?></span><?php } ?></a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="instruments">
      <ul>
        <?php foreach ($site->nodes as $node): ?>
        <li><?= $this->html->link($node->name,['controller'=>'nodes','action'=>'view',$node->reference_designator]) ?> <small>(<?= h($node->reference_designator) ?>)</small>
          <ul>
            <?php foreach ($node->instruments as $instrument): ?>
            <li><?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endforeach; ?>
      </ul>

    </div>
    <div role="tabpanel" class="tab-pane" id="deployments">

    <?php if (count($site->deployments)>0): ?>
      <table class="table table-striped">
        <tr>
          <th>Deployment Number</th>
          <th>Mooring Barcode</th>
          <th>Mooring Serial Number</th>
          <th>Anchor Launch Date</th>
          <th>Anchor Launch Time</th>
          <th>Recover Date</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Water Depth</th>
          <th>Cruise Number</th>
          <th>Notes</th>
        </tr>
        <?php foreach ($site->deployments as $d): ?>
        <tr>
          <td><?= h($d->deployment_number) ?></td>
          <td><?= $this->Html->link($d->mooring_barcode, ['controller'=>'assets', 'action' => 'view', $d->mooring_barcode]) ?></td>
          <td><?= h($d->mooring_serial_number) ?></td>
          <td><?= $this->Time->format($d->anchor_launch_date, 'MM/dd/yyyy') ?></td>
          <td><?= $this->Time->format($d->anchor_launch_time, 'HH:mm') ?></td>
          <td><?= $d->recover_date ?></td>
          <td><?= h($d->latitude) ?></td>
          <td><?= h($d->longitude) ?></td>
          <td><?= h($d->water_depth) ?></td>
          <td><?= h($d->cruise_number) ?></td>
          <td><?= h($d->notes) ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>No deployments found</p>
    <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="notes">

      <?php echo $this->element('notes_table', ['notes'=>$site->notes]); ?>
      
      <p class="text-left">
        <?php echo $this->Html->link(__('New Note'), ['controller'=>'annotations','action'=>'add',$site->reference_designator], ['class'=>'btn btn-primary']); ?>
      </p>

    </div>
    <div role="tabpanel" class="tab-pane" id="annotations">

      <?php echo $this->element('annotations_table', ['annotations'=>$site->annotations]); ?>
      
    </div>
  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->


<!-- Stats Graph -->
<?php $this->Html->css('https://fonts.googleapis.com/css?family=Muli',['block'=>true]); ?>
<?php $this->Html->css('/visavail/css/visavail.css',['block'=>true]); ?>
<?php $this->Html->css('/font-awesome/css/font-awesome.min.css',['block'=>true]); ?>
<?php $this->Html->script('/moment/moment-with-locales.min.js',['block'=>true]); ?>
<?php $this->Html->script('/d3/d3.min.js',['block'=>true]); ?>
<?php $this->Html->script('/visavail/js/visavail.js',['block'=>true]); ?>
<?php 
  $data=[];
  if (count($site->deployments)>0) {
    $data_deployments = [
      'measure'=>'Deployments',
      'categories'=>[
        'Deployed'=>['color'=>'#00be70']
      ]
    ];
    foreach ($site->deployments as $d) {
      $data_deployments['data'][] = [
        $this->Time->i18nFormat($d->start_date,'yyyy-MM-dd HH:mm:ss'), 
        'Deployed', 
        ($d->stop_date) ? $this->Time->i18nFormat($d->stop_date,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
    }
    array_push($data,$data_deployments);
  }
  if ($site->annotations->count()>0) {
    $data_annotations = [
      'measure'=>'Annotations',
      'categories'=>[
        'PENDING_INGEST'=>['color'=>'blue'],
        'NOT_OPERATIONAL'=>['color'=>'red'],
        'NOT_AVAILABLE'=>['color'=>'red'],
        'Unknown'=>['color'=>'gray'],
      ]
    ];
    foreach ($site->annotations as $a) {
      if ($a->start_datetime) {
        $data_annotations['data'][] = [
          $this->Time->i18nFormat($a->start_datetime,'yyyy-MM-dd HH:mm:ss'), 
          ($a->status) ? $a->status : 'Unknown', 
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
