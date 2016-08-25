<ol class="breadcrumb">
  <li class="active">Test Runs</li>
</ol>

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
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($testRuns as $testRun): ?>
        <tr>
            <td><?= $this->Number->format($testRun->id) ?></td>
            <td><?= $testRun->has('user') ? h($testRun->user->full_name) : '' ?></td>
            <td><?= $this->Html->link($testRun->name, ['action' => 'view', $testRun->id]) ?></td>
            <td><?= $this->Html->link($testRun->reference_designator,['controller'=>'instruments','action'=>'view',$testRun->reference_designator]) ?></td>
            <td><?= h($testRun->deployment) ?></td>
            <td><?= h($testRun->status) ?></td>
            <td><?= h($testRun->created) ?></td>
            <td><?= h($testRun->modified) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
