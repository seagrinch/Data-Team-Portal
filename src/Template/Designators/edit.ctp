<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $designator->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $designator->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($designator); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Designator']) ?></legend>
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
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
