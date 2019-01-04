<?php $this->assign('title',$site->reference_designator)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'view',$site->region->reference_designator]) ?></li>
  <li class="active"><?= h($site->name) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <!--
    <?php 
      $session = $this->request->session();
      if ($session->check('Auth.User')) { 
        echo $this->Html->link('Edit Site', ['action'=>'edit', $site->reference_designator], ['class'=>'btn btn-info']);
      }
    ?>
    -->
    <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'http://oceanobservatories.org/site/' . substr($site->reference_designator,0,8), 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
    <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'https://ooinet.oceanobservatories.org/plot/#' . $site->reference_designator, 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
  </div>
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'view', $site->reference_designator],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-daily', $site->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-monthly', $site->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
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
<!--
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
-->
</dl>


<!-- Stats Graph -->
<?php echo $this->element('availability_chart', [
  'deployments'=>$site->deployments, 
  'annotations'=>$site->annotations
  ]); ?>


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
            <li><?php echo $this->element('instrument_status', ['status'=>$instrument->current_status,'notitle'=>true]); ?>
                <?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'report',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small>
                <?php
                  if ($instrument->note) {
                    echo $this->Text->insert('<span class="glyphicon glyphicon-star" style="font-size: 1.0em; color:orange;" aria-hidden="true" data-toggle="tooltip" title=":title"></span>',['title'=>$instrument->note]);
                  } ?>
                </li>
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
          <?php foreach ($site->deployments as $d): ?>
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

      <?php echo $this->element('notes_table', ['notes'=>$site->notes]); ?>
      
      <p class="text-left">
        <?php echo $this->Html->link(__('New Note'), ['controller'=>'notes','action'=>'add',$site->reference_designator], ['class'=>'btn btn-primary']); ?>
      </p>

    </div>
    <div role="tabpanel" class="tab-pane" id="annotations">

      <?php echo $this->element('annotations_table', ['annotations'=>$site->annotations]); ?>
      
    </div>
  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->


<?php $this->Html->scriptStart(['block' => true]); ?>
  // Initialize Tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

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
