<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dataStream->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dataStream->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Data Streams'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Instruments'), ['controller' => 'Instruments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Instrument'), ['controller' => 'Instruments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dataStreams form large-9 medium-8 columns content">
    <?= $this->Form->create($dataStream) ?>
    <fieldset>
        <legend><?= __('Edit Data Stream') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('instrument_id', ['options' => $instruments, 'empty' => true]);
            echo $this->Form->input('method');
            echo $this->Form->input('stream_name');
            echo $this->Form->input('stream_id', ['options' => $streams, 'empty' => true]);
            echo $this->Form->input('uframe_route');
            echo $this->Form->input('driver');
            echo $this->Form->input('parser');
            echo $this->Form->input('instrument_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
