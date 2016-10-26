<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Assets'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($asset->asset_uid) ?></li>
</ol>

<h3>Asset: <?= h($asset->asset_uid) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Type') ?></dt>
  <dd><?= h($asset->type) ?></dd>
  <dt><?= __('Mobile') ?></dt>
  <dd><?= h($asset->mobile) ?></dd>
  <dt><?= __('Description of Equipment') ?></dt>
  <dd><?= h($asset->description_of_equipment) ?></dd>
  <dt><?= __('Manufacturer') ?></dt>
  <dd><?= h($asset->manufacturer) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($asset->model) ?></dd>
  <dt><?= __('Manufacturer Serial No') ?></dt>
  <dd><?= h($asset->manufacturer_serial_no) ?></dd>
  <dt><?= __('Firmware Version') ?></dt>
  <dd><?= h($asset->firmware_version) ?></dd>
  <dt><?= __('Acquisition Date') ?></dt>
  <dd><?= h($asset->acquisition_date) ?></dd>
  <dt><?= __('Original Cost') ?></dt>
  <dd><?= $this->Number->currency($asset->original_cost) ?></dd>
  <dt><?= __('Comments') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($asset->comments)); ?></dd>
</dl>

<!-- Tabbed Navigation -->
<div>
  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#calibrations" aria-controls="calibrations" role="tab" data-toggle="tab">Calibrations</a></li>
  </ul>
  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="deployments">

      <?php if (count($asset->sensor_deployments)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Deployment Cruise</th>
            <th>Reference Designator</th>
            <th>Deployment Number</th>
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
          <?php foreach ($asset->sensor_deployments as $d): ?>
          <tr>
            <td><?= $this->Html->link($d->deploy_cuid, ['controller'=>'cruises', 'action' => 'view', $d->deploy_cuid]) ?></td>
            <td><?= $this->Html->link($d->reference_designator, ['controller'=>'instruments', 'action' => 'view', $d->reference_designator]) ?></td>
            <td><?= h($d->deployment_number) ?></td>
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
        <p>No sensor deployments found</p>
      <?php endif; ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="calibrations">

      <?php if (count($asset->calibrations)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Class</th>
            <th>Asset UID</th>
            <th>Start Date</th>
            <th>Serial</th>
            <th>Name</th>
            <th>Value</th>
            <th>Notes</th>
          </tr>
          <?php foreach ($asset->calibrations as $cal): ?>
          <tr>
            <td><?= h($cal->class) ?></td>
            <td><?= $this->Html->link($cal->asset_uid, ['controller'=>'assets', 'action' => 'view', $cal->asset_uid]) ?></td>
            <td><?= $this->Time->format($cal->start_date, 'MM/dd/yyyy') ?></td>
            <td><?= h($cal->serial) ?></td>
            <td><?= h($cal->name) ?></td>
            <td><?= h($cal->value) ?></td>
            <td><?= h($cal->notes) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p>No deployments found</p>
      <?php endif; ?>

    </div>
  </div><!-- End Tab Content -->
</div><!-- End Tabbed Navigation -->
