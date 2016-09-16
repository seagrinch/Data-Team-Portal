<ol class="breadcrumb">
  <li class="active">Test Runs</li>
</ol>

<div class="btn-group pull-right" role="group" aria-label="...">
  <?php echo $this->Html->link('<span class="glyphicon glyphicon glyphicon-download-alt" aria-hidden="true"></span> CSV', ['action'=>'exportall'], ['class'=>'btn btn-default', 'escape'=>false]); ?>
</div>


<h3><?= __('Test Runs') ?></h3>
<table class="table table-striped table-condensed table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('User.full_name','Owner') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('reference_designator') ?></th>
            <th><?= $this->Paginator->sort('deployment') ?></th>
            <th><?= $this->Paginator->sort('status') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th><?= $this->Paginator->sort('count_items','Count') ?></th>
            <th>Complete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($testRuns as $testRun): ?>
        <tr>
            <td><?= $this->Number->format($testRun->id) ?></td>
            <td><?= $testRun->has('user') ? h($testRun->user->first_name) : '' ?></td>
            <td><?= $this->Html->link($testRun->name, ['action' => 'view', $testRun->id]) ?></td>
            <td><?= $this->Html->link($testRun->reference_designator,['controller'=>'instruments','action'=>'view',$testRun->reference_designator, '#'=>'tests']) ?></td>
            <td><?= h($testRun->deployment) ?></td>
            <td><?= h($testRun->status) ?></td>
            <td><?= h($testRun->modified) ?></td>
            <td><?= h($testRun->count_items) ?></td>
            <td>
              <?php
                if ($testRun->count_items) {
                  echo $this->Number->toPercentage( ($testRun->count_complete_good + $testRun->count_complete_bad + $testRun->count_reasonable_good + $testRun->count_reasonable_bad) / (2 * $testRun->count_items), 1, ['multiply'=>true]);
                }
              ?> 
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
