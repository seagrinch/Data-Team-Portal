<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $instrumentClass->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $instrumentClass->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Instrument Classes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="instrumentClasses form large-9 medium-8 columns content">
    <?= $this->Form->create($instrumentClass) ?>
    <fieldset>
        <legend><?= __('Edit Instrument Class') ?></legend>
        <?php
            echo $this->Form->input('class');
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('primary_science_dicipline');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
