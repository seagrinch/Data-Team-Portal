<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Runs'), ['controller'=>'test-runs', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($testItem->test_run->name . ' (#' . $this->Number->format($testItem->test_run->id) . ')' , ['controller'=>'test-runs', 'action' => 'view', $testItem->test_run->id]) ?></li>
  <li class="active">Test #<?= $this->Number->format($testItem->id) ?></li>
</ol>

<div class="row">
  <div class='col-md-6'>
    <dl class="dl-horizontal">
      <dt>Reference Designator</dt>
      <dd><?= $this->Html->link($testItem->test_run->reference_designator,['controller'=>'instruments','action'=>'view',$testItem->test_run->reference_designator]) ?></dd>
      <dt>Method</dt>
      <dd><?= h($testItem->method) ?></dd>
      <dt>Stream</dt>
      <dd><?= ($testItem->stream) ? h($testItem->stream->name) : '' ?></dd>
      <dt>&nbsp;</dt>
      <dd>&nbsp;</dd>
      <dt>Parameter</dt>
      <dd><?= ($testItem->parameter) ? h($testItem->parameter->name) . ' (PD' . h($testItem->parameter->id) . ')' : '' ?></dd>
      <dt>Units</dt>
      <dd><?= ($testItem->parameter) ? h($testItem->parameter->unit) : '' ?></dd>
      <dt>Fill Value</dt>
      <dd><?= ($testItem->parameter) ? h($testItem->parameter->fill_value) : '' ?></dd>
      <dt>Data Product</dt>
      <dd><?= ($testItem->parameter) ? h($testItem->parameter->data_product_identifier) : '' ?></dd>
    </dl>
  </div>
  <div class='col-md-6'>
    <?= $this->Form->create($testItem) ?>
    <fieldset>
        <legend><?= __('Edit Test Result') ?></legend>
        <?php
            echo $this->Form->input('status_complete',[
              'label' => "The parameter's record is complete",
              'options' => [
                'Pass'=>'Pass',
                'Fail'=>'Fail',
                'n/a'=>'Not Available'
              ],
              'empty' => true]);
            echo $this->Form->input('status_reasonable',[
              'label' => "The science parameter's values are reasonable",
              'options' => [
                'Pass'=>'Pass',
                'Fail'=>'Fail',
                'Suspect'=>'Suspect',
                'Software'=>'Software Investigation',
                'n/r'=>'Not for review',
                'n/a'=>'Not Available'
              ],
              'empty' => true]);
            echo $this->Form->input('comment');
            echo $this->Form->input('redmine_issue');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
