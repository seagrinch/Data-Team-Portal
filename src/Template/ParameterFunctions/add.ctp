<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Parameter Functions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parameterFunctions form large-9 medium-8 columns content">
    <?= $this->Form->create($parameterFunction) ?>
    <fieldset>
        <legend><?= __('Add Parameter Function') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('function_type');
            echo $this->Form->input('function');
            echo $this->Form->input('owner');
            echo $this->Form->input('description');
            echo $this->Form->input('qc_flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
