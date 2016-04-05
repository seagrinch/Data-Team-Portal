<?php
$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $parameter->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameter Functions'), ['controller' => 'ParameterFunctions', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter Function'), ['controller' => 'ParameterFunctions', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $parameter->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Parameter Functions'), ['controller' => 'ParameterFunctions', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Parameter Function'), ['controller' => 'ParameterFunctions', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($parameter); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Parameter']) ?></legend>
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('unit');
    echo $this->Form->input('fill_value');
    echo $this->Form->input('display_name');
    echo $this->Form->input('standard_name');
    echo $this->Form->input('precision');
    echo $this->Form->input('parameter_function_id', ['options' => $parameterFunctions]);
    echo $this->Form->input('parameter_function_map');
    echo $this->Form->input('data_product_identifier');
    echo $this->Form->input('description');
    echo $this->Form->input('streams._ids', ['options' => $streams]);
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
