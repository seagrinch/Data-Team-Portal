<h3><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?> / 
<?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?> / 
<?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></h3>

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
</dl>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams/Parameters</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#calibrations" aria-controls="calibrations" role="tab" data-toggle="tab">Calibrations</a></li>
    <li role="presentation"><a href="#instrument" aria-controls="instrument" role="tab" data-toggle="tab">Instrument Info</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="streams">
      <p>Coming Soon</p>

    </div>
    <div role="tabpanel" class="tab-pane" id="deployments">

      <?php if (count($instrument->deployments)>0): ?>
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
          <?php foreach ($instrument->deployments as $d): ?>
          <tr>
            <td><?= h($d->deployment_number) ?></td>
            <td><?= h($d->mooring_barcode) ?></td>
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
    <div role="tabpanel" class="tab-pane" id="calibrations">

      <?php if (count($instrument->calibrations)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Deployment Number</th>
            <th>Mooring Barcode</th>
            <th>Mooring Serial Number</th>
            <th>Sensor Barcode</th>
            <th>Sensor Serial Number</th>
            <th>CC Name</th>
            <th>CC Value</th>
          </tr>
          <?php foreach ($instrument->calibrations as $c): ?>
          <tr>
            <td><?= h($c->deployment_number) ?></td>
            <td><?= h($c->mooring_barcode) ?></td>
            <td><?= h($c->mooring_serial_number) ?></td>
            <td><?= h($c->sensor_barcode) ?></td>
            <td><?= h($c->sensor_serial_number) ?></td>
            <td><?= h($c->cc_name) ?></td>
            <td><?= h($c->cc_value) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No calibrations found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="instrument">

      <dl class="dl-horizontal">
        <dt><?= __('Class') ?></dt>
        <dd><?= h($instrument_class->class) ?></dd>
        <dt><?= __('Name') ?></dt>
        <dd><?= h($instrument_class->name) ?></dd>
        <dt><?= __('Description') ?></dt>
        <dd><?= h($instrument_class->description) ?></dd>
        <dt><?= __('Primary Science Discipline') ?></dt>
        <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>

        <dt><?= __('Series') ?></dt>
        <dd><?= h($instrument_model->series) ?></dd>
        <dt><?= __('Make') ?></dt>
        <dd><?= h($instrument_model->make) ?></dd>
        <dt><?= __('Model') ?></dt>
        <dd><?= h($instrument_model->model) ?></dd>
      </dl>      

    </div>
    <div role="tabpanel" class="tab-pane" id="notes">

      <p>Coming soon</p>

    </div>
  </div>

</div>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($designator);
*/
?>
