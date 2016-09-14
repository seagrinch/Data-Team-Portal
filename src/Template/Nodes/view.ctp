<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($node->site->region->name,['controller'=>'regions','action'=>'view',$node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($node->site->name,['controller'=>'sites','action'=>'view',$node->site->reference_designator]) ?></li>
  <li class="active"><?= h($node->name) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'http://oceanobservatories.org/site/' . substr($node->reference_designator,0,8), ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 'https://ooiui.oceanobservatories.org/plot/#' . $node->reference_designator, ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>

<h3><?= h($node->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($node->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $node->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($node->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($node->longitude) ?></dd>
  <dt><?= __('Depth') ?></dt>
  <dd><?= $this->Number->format($node->end_depth) ?></dd>
</dl>

<div><!-- Tabbed Navigation -->

  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#instruments" aria-controls="instruments" role="tab" data-toggle="tab">Instruments</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="instruments">
      <ul>
        <?php foreach ($node->instruments as $instrument): ?>
        <li><?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small></li>
        <?php endforeach; ?>
      </ul>

    </div>
    <div role="tabpanel" class="tab-pane" id="deployments">

      <?php if (count($node->deployments)>0): ?>
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
          <?php foreach ($node->deployments as $d): ?>
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

      <?php echo $this->element('notes', ['notes'=>$node->notes]); ?>
      <p class="text-left"><?php echo $this->Html->link(__('Add a New Note'), ['controller'=>'notes','action'=>'add','nodes',$node->reference_designator], ['class'=>'btn btn-primary']); ?></p>

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
