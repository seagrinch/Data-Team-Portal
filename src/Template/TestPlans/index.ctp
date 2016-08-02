<ol class="breadcrumb">
  <li class="active">Test Plans</li>
</ol>

<h3><?= __('Test Plans') ?></h3>
<table class="table table-striped table-condensed table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('User.full_name','Owner') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('status') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($testPlans as $testPlan): ?>
        <tr>
            <td><?= $this->Number->format($testPlan->id) ?></td>
            <td><?= $testPlan->has('user') ? h($testPlan->user->full_name) : '' ?></td>
            <td><?= $this->Html->link($testPlan->name, ['action' => 'view', $testPlan->id]) ?></td>
            <td><?= h($testPlan->status) ?></td>
            <td><?= h($testPlan->created) ?></td>
            <td><?= h($testPlan->modified) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="text-right"><?php echo $this->Html->link(__('Add a Test Plan'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
