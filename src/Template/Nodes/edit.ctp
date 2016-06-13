<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $node->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $node->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Nodes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="nodes form large-9 medium-8 columns content">
    <?= $this->Form->create($node) ?>
    <fieldset>
        <legend><?= __('Edit Node') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('region');
            echo $this->Form->input('site');
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
