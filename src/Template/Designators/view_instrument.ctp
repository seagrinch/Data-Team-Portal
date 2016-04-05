<h3><?= $this->html->link($platform->parent->name,['action'=>'view',$platform->parent->reference_designator]) ?> / 
<?= $this->html->link($platform->name,['action'=>'view',$platform->reference_designator]) ?> / 
<?= $this->html->link($designator->parent->name,['action'=>'view',$designator->parent->reference_designator]) ?></h3>

<h3><?= h($designator->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($designator->reference_designator) ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($designator->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($designator->longitude) ?></dd>
  <dt><?= __('Start Depth') ?></dt>
  <dd><?= $this->Number->format($designator->start_depth) ?></dd>
  <dt><?= __('End Depth') ?></dt>
  <dd><?= $this->Number->format($designator->end_depth) ?></dd>
</dl>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#calibrations" aria-controls="calibrations" role="tab" data-toggle="tab">Calibrations</a></li>
    <li role="presentation"><a href="#instrument" aria-controls="instrument" role="tab" data-toggle="tab">Instrument Info</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="streams">
      <?php if ( count($designator->streams)>0 ): ?>
        <div class="row">
        <?php foreach ($designator->streams as $s): ?>
          <div class="col-md-3">
          <h4><?= $this->html->link($s->name,['controller'=>'streams','action'=>'view',$s->id]) ?></h4>
            <?php if ( count($s->parameters)>0 ): ?>
            <ul>
              <?php foreach ($s->parameters as $p): ?>
              <li><?= $this->html->link($p->name,['controller'=>'parameters','action'=>'view',$p->id]) ?></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>No deployments found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="deployments">

      <?php if ($deployments->count()>0): ?>
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
          <?php foreach ($deployments as $d): ?>
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

      <p>Coming soon</p>

    </div>
    <div role="tabpanel" class="tab-pane" id="instrument">

      <dl class="dl-horizontal">
        <dt><?= __('Class') ?></dt>
        <dd><?= h($instrument_class->class) ?></dd>
        <dt><?= __('Name') ?></dt>
        <dd><?= h($instrument_class->name) ?></dd>
        <dt><?= __('Description') ?></dt>
        <dd><?= h($instrument_class->description) ?></dd>
        <dt><?= __('Primary Science Dicipline') ?></dt>
        <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>

        <dt><?= __('Series') ?></dt>
        <dd><?= h($instrument_model->series) ?></dd>
        <dt><?= __('Manufacturer') ?></dt>
        <dd><?= h($instrument_model->manufacturer) ?></dd>
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
