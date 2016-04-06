<?php
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Parameter Functions'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Parameter Functions'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($parameterFunction); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Parameter Function']) ?></legend>
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('function_type');
    echo $this->Form->input('function');
    echo $this->Form->input('owner');
    echo $this->Form->input('description');
    echo $this->Form->input('qc_flag');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
