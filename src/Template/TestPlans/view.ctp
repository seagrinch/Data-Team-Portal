<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Test Plan'), ['action' => 'edit', $testPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Test Plan'), ['action' => 'delete', $testPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Test Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Test Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Test Runs'), ['controller' => 'TestRuns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Test Run'), ['controller' => 'TestRuns', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="testPlans view large-9 medium-8 columns content">
    <h3><?= h($testPlan->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($testPlan->name) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $testPlan->has('user') ? $this->Html->link($testPlan->user->username, ['controller' => 'Users', 'action' => 'view', $testPlan->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($testPlan->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($testPlan->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($testPlan->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($testPlan->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Test Runs') ?></h4>
        <?php if (!empty($testPlan->test_runs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Test Plan Id') ?></th>
                <th><?= __('Test Question Id') ?></th>
                <th><?= __('Reference Designator') ?></th>
                <th><?= __('Method') ?></th>
                <th><?= __('Stream Id') ?></th>
                <th><?= __('Parameter Id') ?></th>
                <th><?= __('Result') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($testPlan->test_runs as $testRuns): ?>
            <tr>
                <td><?= h($testRuns->id) ?></td>
                <td><?= h($testRuns->test_plan_id) ?></td>
                <td><?= h($testRuns->test_question_id) ?></td>
                <td><?= h($testRuns->reference_designator) ?></td>
                <td><?= h($testRuns->method) ?></td>
                <td><?= h($testRuns->stream_id) ?></td>
                <td><?= h($testRuns->parameter_id) ?></td>
                <td><?= h($testRuns->result) ?></td>
                <td><?= h($testRuns->created) ?></td>
                <td><?= h($testRuns->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TestRuns', 'action' => 'view', $testRuns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TestRuns', 'action' => 'edit', $testRuns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TestRuns', 'action' => 'delete', $testRuns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testRuns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
