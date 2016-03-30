<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($designator); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Designator']) ?></legend>
    <?php
    echo $this->Form->input('reference_designator');
    echo $this->Form->input('designator_type');
    echo $this->Form->input('name');
    echo $this->Form->input('description');
    echo $this->Form->input('type');
    echo $this->Form->input('location');
    echo $this->Form->input('start_depth');
    echo $this->Form->input('end_depth');
    echo $this->Form->input('latitude');
    echo $this->Form->input('longitude');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
