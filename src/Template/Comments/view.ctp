<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comments view large-9 medium-8 columns content">
    <h3><?= h($comment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model') ?></th>
            <td><?= h($comment->model) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $comment->has('user') ? $this->Html->link($comment->user->username, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($comment->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Reference Designator') ?></th>
            <td><?= h($comment->reference_designator) ?></td>
        </tr>
        <tr>
            <th><?= __('Redmine Issue') ?></th>
            <td><?= h($comment->redmine_issue) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($comment->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Model Id') ?></th>
            <td><?= $this->Number->format($comment->model_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Resolved') ?></th>
            <td><?= h($comment->resolved) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($comment->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($comment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($comment->body)); ?>
    </div>
    <div class="row">
        <h4><?= __('Resolved Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($comment->resolved_comment)); ?>
    </div>
</div>
