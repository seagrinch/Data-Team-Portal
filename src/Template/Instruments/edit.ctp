<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $instrument->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $instrument->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Instruments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Data Streams'), ['controller' => 'DataStreams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Data Stream'), ['controller' => 'DataStreams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instruments form large-9 medium-8 columns content">
    <?= $this->Form->create($instrument) ?>
    <fieldset>
        <legend><?= __('Edit Instrument') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('region');
            echo $this->Form->input('site');
            echo $this->Form->input('node');
            echo $this->Form->input('name');
            echo $this->Form->input('start_depth');
            echo $this->Form->input('end_depth');
            echo $this->Form->input('location');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
