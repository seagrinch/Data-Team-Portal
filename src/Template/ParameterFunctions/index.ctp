<h3>Parameter Functions</h3>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('function_type'); ?></th>
            <th><?= $this->Paginator->sort('function'); ?></th>
            <th><?= $this->Paginator->sort('owner'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parameterFunctions as $parameterFunction): ?>
        <tr>
            <td><?= $this->Number->format($parameterFunction->id) ?></td>
            <td><?= $this->Html->link($parameterFunction->name,['action'=>'view',$parameterFunction->id]) ?></td>
            <td><?= h($parameterFunction->function_type) ?></td>
            <td><?= h($parameterFunction->function) ?></td>
            <td><?= h($parameterFunction->owner) ?></td>
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