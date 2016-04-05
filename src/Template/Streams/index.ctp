<?php
/* @var $this \Cake\View\View */
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Stream'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Designators'), ['controller' => 'Designators', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Designator'), ['controller' => ' Designators', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => ' Parameters', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('time_parameter'); ?></th>
            <th><?= $this->Paginator->sort('uses_ctd'); ?></th>
            <th><?= $this->Paginator->sort('binsize_minutes'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($streams as $stream): ?>
        <tr>
            <td><?= $this->Number->format($stream->id) ?></td>
            <td><?= h($stream->name) ?></td>
            <td><?= $this->Number->format($stream->time_parameter) ?></td>
            <td><?= h($stream->uses_ctd) ?></td>
            <td><?= $this->Number->format($stream->binsize_minutes) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $stream->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $stream->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $stream->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stream->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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