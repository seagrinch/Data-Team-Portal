<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'view',$site->region->reference_designator]) ?></li>
  <li class="active"><?= h($site->name) ?></li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->check('Auth.User')) { 
    echo $this->Html->link('Edit Site', ['action'=>'edit', $site->reference_designator], ['class'=>'btn btn-info pull-right']);
  }
?>

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
      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> Deployed
    <?php } elseif ($site->current_status=='recovered') { ?>
      <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red;"></span> Recovered
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
</dl>

<h3>Nodes & Instruments</h3>
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

<div class="row">
  <div class='col-md-9'>
    
    <h3>Notes</h3>
    <?php if (count($site->notes)>0): ?>
      <?php foreach ($site->notes as $note): ?>
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
    <p class="text-left"><?php echo $this->Html->link(__('Add a New Note'), ['controller'=>'notes','action'=>'add','sites',$site->reference_designator], ['class'=>'btn btn-primary']); ?></p>
    
  </div>
</div>


<h3>Deployments</h3>
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



<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($site);
*/
?>