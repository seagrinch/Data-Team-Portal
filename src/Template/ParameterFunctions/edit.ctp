<?php
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $parameterFunction->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $parameterFunction->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Parameter Functions'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $parameterFunction->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $parameterFunction->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Parameter Functions'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($parameterFunction); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Parameter Function']) ?></legend>
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('function_type');
    echo $this->Form->input('function');
    echo $this->Form->input('owner');
    echo $this->Form->input('description');
    echo $this->Form->input('qc_flag');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
