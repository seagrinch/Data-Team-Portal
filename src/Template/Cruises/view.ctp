<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruises'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($cruise->cuid) ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?= $this->Html->link('View Review', ['controller'=>'cruise-reviews', 'action'=>'view', $cruise->cuid], ['class'=>'btn btn-default']);?>
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Review', ['controller'=>'cruise-reviews', 'action'=>'edit', $cruise->cuid], ['class'=>'btn btn-info']);
    }
  ?>
</div>

<h2>Cruise: <?= h($cruise->cuid) ?></h2>

<div class="row">
  <div class="col-md-6">
    <dl class="dl-horizontal">
      <dt><?= __('Ship Name') ?></dt>
      <dd><?= h($cruise->ship_name) ?></dd>
      <dt><?= __('Cruise Start Date') ?></dt>
      <dd><?= h($cruise->cruise_start_date) ?></dd>
      <dt><?= __('Cruise End Date') ?></dt>
      <dd><?= h($cruise->cruise_end_date) ?></dd>
      <dt><?= __('Notes') ?></dt>
      <dd><?= $this->Text->autoParagraph(h($cruise->notes)); ?></dd>
    </dl>
  </div>
  <?php if ($cruise->has('cruise_review')): ?>
  <div class="col-md-6">
    <dl class="dl-horizontal">
      <dt><?= __('Reviewer') ?></th></dt>
      <dd><?= $cruise->cruise_review->has('user') ? $this->Html->link($cruise->cruise_review->user->username, ['controller' => 'Users', 'action' => 'view', $cruise->cruise_review->user->username]) : '' ?></dd>
      <dt><?= __('Review Status') ?></dt>
      <dd><?= h($cruise->cruise_review->status) ?></dd>
      <dt><?= __('Modified') ?></dt>
      <dd><?= $this->Time->timeAgoInWords($cruise->cruise_review->modified) ?></dd>  
    </dl>
  </div>
  <?php endif; ?>
</div>

<h4>Instrument deployments during this cruise</h4>

<?php if (count($cruise->deployments)>0): ?>
  <table class="table table-striped">
    <tr>
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
    <?php foreach ($cruise->deployments as $d): ?>
    <tr>
      <td><?= $this->Ooi->rdLink($d->reference_designator) ?></td>
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
  <p>No deployments found</p>
<?php endif; ?>
