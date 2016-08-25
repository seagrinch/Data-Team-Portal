<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Runs'), ['controller'=>'test-runs', 'action' => 'index']) ?></li>
  <li class="active"><?= h($testRun->name) ?> (#<?= $this->Number->format($testRun->id) ?>)</li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->read('Auth.User.id')==$testRun->user_id): 
  ?>
  <div class="btn-group pull-right" role="group">
    <?= $this->Html->link('Edit Test Run', ['action'=>'edit', $testRun->id], ['class'=>'btn btn-info']); ?>
  </div>
<?php endif; ?>

<h3><?= h($testRun->name) ?> (#<?= $this->Number->format($testRun->id) ?>)</h3>

<dl class="dl-horizontal">
  <dt>Reference Designator</dt>
  <dd><?= $this->Html->link($testRun->reference_designator,['controller'=>'instruments','action'=>'view',$testRun->reference_designator]) ?></dd>
  <dt>Deployment</dt>
  <dd><?= h($testRun->deployment) ?></dd>
  <dt>Owner</dt>
  <dd><?= $testRun->has('user') ? $testRun->user->full_name : '' ?></dd>
  <dt>Date Range</dt>
  <dd><?php if ($testRun->start_date) { ?>
    <?= $this->Time->i18nFormat($testRun->start_date,'MMMM d, yyyy')  ?> to 
    <?= $this->Time->i18nFormat($testRun->end_date,'MMMM d, yyyy') ?>
    <?php } ?></dd>
  <dt>Revised</dt>
  <dd><?= $this->Time->timeAgoInWords($testRun->modified) ?></dd>
  <dt>Status</dt>
  <dd><?= h($testRun->status) ?></dd>
</dl>


<h3><?= __('Parameter Tests') ?></h3>
<?php if (count($testItems)>0): ?>
<table class="table table-striped table-condensed table-hover">
    <tr>
        <th><?= $this->Paginator->sort('method') ?></th>
        <th><?= $this->Paginator->sort('Streams.name','Stream') ?></th>
        <th><?= $this->Paginator->sort('Parameters.name','Parameter') ?></th>
        <th><?= $this->Paginator->sort('status_complete','Complete?') ?></th>
        <th><?= $this->Paginator->sort('status_reasonable','Reasonable?') ?></th>
        <th></th>
    </tr>
    <?php foreach ($testItems as $testItem): ?>
    <tr>
        <td><?= h($testItem->method) ?>
          <?php 
            if ($session->read('Auth.User.id')==$testRun->user_id) { 
              echo $this->Form->postLink(
              '<span class="glyphicon glyphicon-remove" style="color:red;" aria-hidden="true">',
              ['controller'=>'test-items','action'=>'delete',$testItem->id],
              ['confirm' => __('Are you sure you want to delete #{0}?', $testItem->id),'escape'=>false]
              );
            } ?>
        </td>
        <td><?= ($testItem->stream) ? h($testItem->stream->name) . ' (#' . h($testItem->stream->id) . ')' : '' ?></td>
        <td><?= ($testItem->parameter) ? h($testItem->parameter->name) . ' (PD' . h($testItem->parameter->id) . ')': '' ?></td>
        <td><?= h($testItem->status_complete) ?></td>
        <td><?= h($testItem->status_reasonable) ?></td>
        <td>
          <?= $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true">',['controller'=>'test-items','action'=>'edit',$testItem->id],['escape'=>false])?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p>Page <?= $this->Paginator->counter() ?></p>
</div>

<?php else: ?>
<p>No test items.</p>
<?php endif; ?>

