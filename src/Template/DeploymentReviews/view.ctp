<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Deployment Reviews'), ['controller'=>'deployment_reviews', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($deploymentReview->reference_designator,['controller'=>'instruments','action'=>'view',$deploymentReview->reference_designator]) ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></li>
</ol>


<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Review', ['action'=>'edit', $deploymentReview->reference_designator, $deploymentReview->deployment_number], ['class'=>'btn btn-info']);
    }
  ?>
</div>


<h2>Deployment <?= h($deploymentReview->deployment_number); ?> of <?= h($deploymentReview->reference_designator); ?></h2>

<div class="row">
  <div class="col-md-6">

    <dl class="dl-horizontal">
      <dt><?= __('Available Streams') ?></dt>
      <dd><?= h($deploymentReview->available_streams) ?></dd>
      <dt><?= __('Cruise Data Check') ?></dt>
      <dd><?= h($deploymentReview->cruise_data_check) ?></dd>
      <dt><?= __('Completed Date') ?></dt>
      <dd><?= h($deploymentReview->completed_date) ?></dd>
    </dl>

  </div>
  <div class="col-md-6">

    <dl class="dl-horizontal">
      <dt><?= __('Review Status') ?></dt>
      <dd><?= h($deploymentReview->status) ?></dd>
      <dt><?= __('Reviewer') ?></dt>
      <dd><?= $deploymentReview->has('user') ? $this->Html->link($deploymentReview->user->username, ['controller' => 'Users', 'action' => 'view', $deploymentReview->user->username]) : '' ?></dd>
      <dt><?= __('Modified') ?></dt>
      <dd><?= $this->Time->timeAgoInWords($deploymentReview->modified) ?></dd>
    </dl>

  </div>
</div>


<h3>Review Notes</h3>
<?php 
  if ($deploymentReview->notes) {
    $parser = new \Netcarver\Textile\Parser();
    echo $parser->textileThis($deploymentReview->notes);
  } else {
    echo 'None';  
  }
?>

<div class="row">
  <div class="col-md-6">
    <h4>Deployment Information</h4>
    <dl class="dl-horizontal">
      <dt>Cruise</dt>
      <dd><?= $this->Html->link($deployment->deploy_cuid, ['controller'=>'cruises', 'action' => 'view', $deployment->deploy_cuid]) ?></dd>
      <dt>Start Date</dt>
      <dd><?= $this->Time->format($deployment->start_date, 'MM/dd/yyyy') ?></dd>
      <dt>Stop Date</dt>
      <dd><?= $this->Time->format($deployment->stop_date, 'MM/dd/yyyy') ?></dd>
      <dt>Mooring Asset</dt>
      <dd><?= $this->Html->link($deployment->mooring_uid, ['controller'=>'assets', 'action' => 'view', $deployment->mooring_uid]) ?></dd>
      <dt>Node Asset</dt>
      <dd><?= $this->Html->link($deployment->node_uid, ['controller'=>'assets', 'action' => 'view', $deployment->node_uid]) ?></dd>
      <dt>Sensor Asset</dt>
      <dd><?= $this->Html->link($deployment->sensor_uid, ['controller'=>'assets', 'action' => 'view', $deployment->sensor_uid]) ?></dd>
      <dt>Latitude</dt>
      <dd><?= h($deployment->latitude) ?></dd>
      <dt>Longitude</dt>
      <dd><?= h($deployment->longitude) ?></dd>
      <dt>Deployment Depth</dt>
      <dd><?= h($deployment->deployment_depth) ?></dd>
      <dt>Water Depth</dt>
      <dd><?= h($deployment->water_depth) ?></dd>
    </dl>
  </div>
  <div class="col-md-6">
    <h4>Asset Information</h4>
    <dl class="dl-horizontal">
      <dt>Asset UID</dt>
      <dd><?= $this->Html->link($asset->asset_uid, ['controller'=>'assets', 'action' => 'view', $asset->asset_uid]) ?></dd>
      <dt>Type </dt>
      <dd><?= h($asset->type) ?></dd>
      <dt>Mobile</dt>
      <dd><?= h($asset->mobile) ?></dd>
      <dt>Description of Equipment</dt>
      <dd><?= h($asset->description_of_equipment) ?></dd>
      <dt>Manufacturer</dt>
      <dd><?= h($asset->manufacturer) ?></dd>
      <dt>Model</dt>
      <dd><?= h($asset->model) ?></dd>
      <dt>Serial Number</dt>
      <dd><?= h($asset->manufacturer_serial_no) ?></dd>
      <dt>Acquisition Date</dt>
      <dd><?= h($asset->acquisition_date) ?></dd>
      <dt>Original Cost</dt>
      <dd><?= $this->Number->currency($asset->original_cost) ?></dd>
    </dl>
  </div>
</div>

<h3>System Annotations</h3>
<?php echo $this->element('annotations_table', ['annotations'=>$annotations]); ?>

<h3>Data Team Notes</h3>
<?php echo $this->element('notes_table', ['notes'=>$notes]); ?>

<h3>Ingestions</h3>
<table class="table table-striped table-hover table-condensed" style="width: auto;">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('reference_designator') ?></th>
      <th scope="col"><?= $this->Paginator->sort('deployment') ?></th>
      <th scope="col"><?= $this->Paginator->sort('method') ?></th>
      <th scope="col"><?= $this->Paginator->sort('status') ?></th>
      <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ingestions as $ingestion): ?>
    <tr>
      <td><?= h($ingestion->reference_designator) ?></td>
      <td><?= h($ingestion->deployment) ?></td>
      <td><?= h($ingestion->method) ?></td>
      <td><?= h($ingestion->status) ?></td>
      <td><?= h($ingestion->notes) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>