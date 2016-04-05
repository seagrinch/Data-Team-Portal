<?php
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Streams'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Designators'), ['controller' => 'Designators', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Designator'), ['controller' => 'Designators', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Streams'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Designators'), ['controller' => 'Designators', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Designator'), ['controller' => 'Designators', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($stream); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Stream']) ?></legend>
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('time_parameter');
    echo $this->Form->input('uses_ctd');
    echo $this->Form->input('binsize_minutes');
    echo $this->Form->input('designators._ids', ['options' => $designators]);
    echo $this->Form->input('parameters._ids', ['options' => $parameters]);
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
