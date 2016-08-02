<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li class="active"><?= h($testPlan->name) ?> (#<?= $this->Number->format($testPlan->id) ?>)</li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->read('Auth.User.id')==$testPlan->user_id): 
  ?>
  <div class="btn-group pull-right" role="group">
    <?= $this->Html->link('Edit Test Plan', ['action'=>'edit', $testPlan->id], ['class'=>'btn btn-info']); ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Test Cases</button> 
  </div>
<?php endif; ?>

<h3><?= h($testPlan->name) ?> (#<?= $this->Number->format($testPlan->id) ?>)</h3>

<dl class="dl-horizontal">
  <dt>Owner</dt>
  <dd><?= $testPlan->has('user') ? $testPlan->user->full_name : '' ?></dd>
  <dt>Date Range</dt>
  <dd><?php if ($testPlan->start_date) { ?>
    <?= $this->Time->i18nFormat($testPlan->start_date,'MMMM d, yyyy')  ?> to 
    <?= $this->Time->i18nFormat($testPlan->end_date,'MMMM d, yyyy') ?>
    <?php } ?></dd>
  <dt>Revised</dt>
  <dd><?= $this->Time->timeAgoInWords($testPlan->modified) ?></dd>
  <dt>Status</dt>
  <dd><?= h($testPlan->status) ?></dd>
</dl>


<h3><?= __('Test Cases') ?></h3>
<?php if (count($testItems)>0): ?>
<table class="table table-striped table-condensed table-hover">
    <tr>
        <th><?= $this->Paginator->sort('reference_designator') ?></th>
        <th><?= $this->Paginator->sort('method') ?> | <?= $this->Paginator->sort('Streams.name','Stream') ?></th>
        <th><?= $this->Paginator->sort('Parameters.name','Parameter') ?></th>
        <th><?= $this->Paginator->sort('TestQuestions.question','Test Question') ?></th>
        <th><?= $this->Paginator->sort('result') ?></th>
        <th></th>
    </tr>
    <?php foreach ($testItems as $testItem): ?>
    <tr>
        <td><?= $this->Html->link($testItem->reference_designator,['controller'=>'instruments','action'=>'view',$testItem->reference_designator]) ?> 
          <?php 
            if ($session->read('Auth.User.id')==$testPlan->user_id) { 
              echo $this->Form->postLink(
              '<span class="glyphicon glyphicon-remove" style="color:red;" aria-hidden="true">',
              ['controller'=>'test-items','action'=>'delete',$testItem->id],
              ['confirm' => __('Are you sure you want to delete #{0}?', $testItem->id),'escape'=>false]
              );
            } ?>
        </td>
        <td><?= h($testItem->method) ?> <br> 
            <?= ($testItem->stream) ? h($testItem->stream->name) . ' (#' . h($testItem->stream->id) . ')' : '' ?></td>
        <td><?= ($testItem->parameter) ? h($testItem->parameter->name) . ' (PD' . h($testItem->parameter->id) . ')': '' ?></td>
        <td><?= h($testItem->test_question->question) ?></td>
        <td><?= h($testItem->result) ?> <?= $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true">',['controller'=>'test-items','action'=>'edit',$testItem->id],['escape'=>false])?></td>
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
<p>No test cases yet.  Add some below to being the fun.</p>
<?php endif; ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Test Cases</h4>
      </div>
      <div class="modal-body">

        <?= $this->Form->create('', [ 'url'=>['action'=>'add-test-items', $testPlan['id'] ] ]); ?>
<!--         <legend><?= __('Add Test Cases') ?></legend> -->
        <?php
          echo $this->Form->input('test_plan_id',['type'=>'hidden','value'=>$testPlan->id]);
          echo $this->Form->input('region',['options'=>$regions,'label'=>'Array','empty'=>'(Choose an Array)']);
          echo $this->Form->input('site',['type'=>'select','label'=>'Site','empty'=>'-- Select an Array first --']);
          echo $this->Form->input('instrument',['type'=>'select','label'=>'Instrument','empty'=>'--']);
          echo $this->Form->input('stream',['type'=>'select','label'=>'Method/Stream','empty'=>'--']);
          echo "<p><strong>Select which test question types you want to add:</strong></p>";
          echo $this->Form->input('instrument_questions',['type'=>'checkbox','checked'=>true]);
          echo $this->Form->input('stream_questions',['type'=>'checkbox','checked'=>true]);
          echo $this->Form->input('parameter_questions',['type'=>'checkbox','checked'=>true]);
        ?>
<!--         <div><strong>Instrument:</strong> <span id="reference-designator">Please select one using the pulldowns</span></div> -->
        <?php echo $this->Html->script('test-case',['block'=>true]);?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?= $this->Form->button(__('Add Test Cases'),['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
