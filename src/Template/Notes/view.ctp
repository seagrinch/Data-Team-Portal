<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note'), ['action' => 'edit', $note->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notes view large-9 medium-8 columns content">
    <h3><?= h($note->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $note->has('user') ? $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($note->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Model') ?></th>
            <td><?= h($note->model) ?></td>
        </tr>
        <tr>
            <th><?= __('Reference Designator') ?></th>
            <td><?= h($note->reference_designator) ?></td>
        </tr>
        <tr>
            <th><?= __('Redmine Issue') ?></th>
            <td><?= h($note->redmine_issue) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($note->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Resolved') ?></th>
            <td><?= h($note->resolved) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($note->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($note->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($note->body)); ?>
    </div>
    <div class="row">
        <h4><?= __('Resolved Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($note->resolved_comment)); ?>
    </div>
</div>
