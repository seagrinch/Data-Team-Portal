<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $testQuestion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $testQuestion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Test Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Test Runs'), ['controller' => 'TestRuns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Test Run'), ['controller' => 'TestRuns', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($testQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Test Question') ?></legend>
        <?php
            echo $this->Form->input('question');
            echo $this->Form->input('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
