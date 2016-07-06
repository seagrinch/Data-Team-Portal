<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li class="active"><?= h($testPlan->name) ?> (#<?= $this->Number->format($testPlan->id) ?>)</li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->check('Auth.User')) { 
    echo $this->Html->link('Edit Test Plan', ['action'=>'edit', $testPlan->id], ['class'=>'btn btn-info pull-right']);
  }
?>

<h3><?= h($testPlan->name) ?> (#<?= $this->Number->format($testPlan->id) ?>)</h3>
<dl class="dl-horizontal">
  <dt>Creator</dt>
  <dd><?= $testPlan->has('user') ? $testPlan->user->full_name : '' ?></dd>
  <dt>Revised</dt>
  <dd><?= $this->Time->nice($testPlan->modified) ?></dd>
  <dt>Status</dt>
  <dd><?= h($testPlan->status) ?></dd>
</dl>

<h4><?= __('Test Cases') ?></h4>
<?php if (!empty($testPlan->test_runs)): ?>
<table class="table table-striped table-condensed table-hover">
    <tr>
        <th><?= __('Test Plan Id') ?></th>
        <th><?= __('Test Question Id') ?></th>
        <th><?= __('Reference Designator') ?></th>
        <th><?= __('Method') ?></th>
        <th><?= __('Stream Id') ?></th>
        <th><?= __('Parameter Id') ?></th>
        <th><?= __('Result') ?></th>
    </tr>
    <?php foreach ($testPlan->test_runs as $testRuns): ?>
    <tr>
        <td><?= h($testRuns->test_plan_id) ?></td>
        <td><?= h($testRuns->test_question_id) ?></td>
        <td><?= h($testRuns->reference_designator) ?></td>
        <td><?= h($testRuns->method) ?></td>
        <td><?= h($testRuns->stream_id) ?></td>
        <td><?= h($testRuns->parameter_id) ?></td>
        <td><?= h($testRuns->result) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
