<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($testItem->test_plan->name . ' (#' . $this->Number->format($testItem->test_plan->id) . ')' , ['controller'=>'test-plans', 'action' => 'view', $testItem->test_plan->id]) ?></li>
  <li class="active">Test #<?= $this->Number->format($testItem->id) ?></li>
</ol>

<div class="row">
  <div class='col-md-6'>
    <dl class="dl-horizontal">
      <dt>Reference Designator</dt>
      <dd><?= $this->Html->link($testItem->reference_designator,['controller'=>'instruments','action'=>'view',$testItem->reference_designator]) ?></dd>
      <dt>Method</dt>
      <dd><?= h($testItem->method) ?></dd>
      <dt>Stream</dt>
      <dd><?= ($testItem->stream) ? h($testItem->stream->name) . ' (#' . h($testItem->stream->id) . ')' : '' ?></dd>
      <dt>Parameter</dt>
      <dd><?= ($testItem->parameter) ? h($testItem->parameter->name) . ' (PD' . h($testItem->parameter->id) . ')': '' ?></dd>
      <dt>Test Question</dt>
      <dd><?= h($testItem->test_question->question) ?></dd>
    </dl>
  </div>
  <div class='col-md-6'>
    <?= $this->Form->create($testItem) ?>
    <fieldset>
        <legend><?= __('Edit Test Item') ?></legend>
        <?php
            echo $this->Form->input('result',['options'=>['Passed'=>'Passed','Failed'=>'Failed'],'empty'=>true]);
            echo $this->Form->input('result_comment');
            echo $this->Form->input('redmine_issue');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
