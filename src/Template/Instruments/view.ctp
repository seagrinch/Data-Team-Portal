<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></li>
  <li class="active"><?= h($instrument->name) ?></li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->check('Auth.User')) { 
    echo $this->Html->link('Edit Instrument', ['action'=>'edit', $instrument->reference_designator], ['class'=>'btn btn-info pull-right']);
  }
?>
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

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
    <li role="presentation"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Streams/Parameters</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="deployments" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#calibrations" aria-controls="calibrations" role="tab" data-toggle="tab">Calibrations</a></li>
    <li role="presentation"><a href="#instrument" aria-controls="instrument" role="tab" data-toggle="tab">Instrument Info</a></li>
    <li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a></li>
    <li role="presentation"><a href="#tests" aria-controls="stats" role="tab" data-toggle="tab">Tests</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="notes">

    <h3>Notes</h3>
    <?php if (count($instrument->notes)>0): ?>
      <?php foreach ($instrument->notes as $note): ?>
        <div class="well">
          <div>
            <?php if ($note->type=='flag'): ?>
              <span class="glyphicon glyphicon-flag" style="color:red;" aria-hidden="true"></span>
            <?php endif; ?> 
            <?php if ($note->redmine_issue): ?>
              <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?></a> 
            <?php endif; ?> 
            <?php if ($note->start_date): ?>
              Annotation Range: <?= h($note->start_date) ?> to <?= h($note->end_date) ?> 
            <?php endif; ?> 
            <?php if ($note->resolved): ?>
              Resolved: <?= h($note->resolved) ?> 
            <?php endif; ?> 
          </div>
          <?= $this->Text->autoParagraph(h($note->comment)); ?>
          <p>
            <small><em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
            <?= $this->Time->timeAgoInWords($note->created) ?></em>
            <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
              [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
            <?php endif; ?>
            </small>
          </p>
          <?php if ($note->resolved_comment): ?>
          <p><strong>Resolved Comment</strong></p>
            <?= $this->Text->autoParagraph(h($note->resolved_comment)); ?> 
          <?php endif; ?> 
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No notes yet.</p>
    <?php endif; ?>
    <p class="text-left"><?php echo $this->Html->link(__('Add a New Note'), ['controller'=>'notes','action'=>'add','instruments',$instrument->reference_designator], ['class'=>'btn btn-primary']); ?></p>

    </div>
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
              <?= $this->Html->link($s->stream->name, ['controller'=>'streams', 'action' => 'view', $s->stream->id]) ?>
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
            <td><?= $this->Html->link($c->mooring_barcode, ['controller'=>'assets', 'action' => 'view', $c->mooring_barcode]) ?></td>
            <td><?= h($c->mooring_serial_number) ?></td>
            <td><?= $this->Html->link($c->sensor_barcode, ['controller'=>'assets', 'action' => 'view', $c->sensor_barcode]) ?></td>
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
    <div role="tabpanel" class="tab-pane" id="stats">

      <?php if (count($instrument->monthly_stats)>0): ?>
        <table class="table table-striped">
          <tr>
            <th>Month</th>
            <th>Deployment Status</th>
            <th>Cassandra Status</th>
            <th>Operational Status</th>
            <th>Reviewed Status</th>
          </tr>
          <?php foreach ($instrument->monthly_stats as $s): ?>
          <tr>
            <td><?= $this->Time->i18nFormat($s->month,'MMMM, yyyy') ?></td>
            <td><?= h($s->deployment_status) ?></td>
            <td><?= h($s->cassandra_status) ?></td>
            <td><?= h($s->operational_status) ?></td>
            <td><?= h($s->reviewed_status) ?></td>
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
  </div><!-- Tab content -->

</div>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($instrument);
*/
?>
