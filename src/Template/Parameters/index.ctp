<?php
/* @var $this \Cake\View\View */
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List ParameterFunctions'), ['controller' => 'ParameterFunctions', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Parameter Function'), ['controller' => ' ParameterFunctions', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Stream'), ['controller' => ' Streams', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('unit'); ?></th>
            <th><?= $this->Paginator->sort('fill_value'); ?></th>
            <th><?= $this->Paginator->sort('display_name'); ?></th>
            <th><?= $this->Paginator->sort('standard_name'); ?></th>
            <th><?= $this->Paginator->sort('precision'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parameters as $parameter): ?>
        <tr>
            <td><?= $this->Number->format($parameter->id) ?></td>
            <td><?= h($parameter->name) ?></td>
            <td><?= h($parameter->unit) ?></td>
            <td><?= h($parameter->fill_value) ?></td>
            <td><?= h($parameter->display_name) ?></td>
            <td><?= h($parameter->standard_name) ?></td>
            <td><?= h($parameter->precision) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $parameter->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $parameter->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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