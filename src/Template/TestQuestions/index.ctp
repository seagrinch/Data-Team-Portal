<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Test Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Test Runs'), ['controller' => 'TestRuns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Test Run'), ['controller' => 'TestRuns', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testQuestions index large-9 medium-8 columns content">
    <h3><?= __('Test Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('question') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testQuestions as $testQuestion): ?>
            <tr>
                <td><?= $this->Number->format($testQuestion->id) ?></td>
                <td><?= h($testQuestion->question) ?></td>
                <td><?= h($testQuestion->type) ?></td>
                <td><?= h($testQuestion->created) ?></td>
                <td><?= h($testQuestion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $testQuestion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testQuestion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testQuestion->id)]) ?>
                </td>
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
</div>
