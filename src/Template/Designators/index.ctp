<?php
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Designator'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('reference_designator'); ?></th>
            <th><?= $this->Paginator->sort('designator_type'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('type'); ?></th>
            <th><?= $this->Paginator->sort('location'); ?></th>
            <th><?= $this->Paginator->sort('start_depth'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($designators as $designator): ?>
        <tr>
            <td><?= $this->Number->format($designator->id) ?></td>
            <td><?= h($designator->reference_designator) ?></td>
            <td><?= h($designator->designator_type) ?></td>
            <td><?= h($designator->name) ?></td>
            <td><?= h($designator->type) ?></td>
            <td><?= h($designator->location) ?></td>
            <td><?= $this->Number->format($designator->start_depth) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $designator->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $designator->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $designator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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