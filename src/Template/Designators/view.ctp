<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Designator'), ['action' => 'edit', $designator->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Designator'), ['action' => 'delete', $designator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]) ?> </li>
<li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Designator'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Designator'), ['action' => 'edit', $designator->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Designator'), ['action' => 'delete', $designator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]) ?> </li>
<li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Designator'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($designator->name) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Reference Designator') ?></td>
            <td><?= h($designator->reference_designator) ?></td>
        </tr>
        <tr>
            <td><?= __('Designator Type') ?></td>
            <td><?= h($designator->designator_type) ?></td>
        </tr>
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($designator->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Type') ?></td>
            <td><?= h($designator->type) ?></td>
        </tr>
        <tr>
            <td><?= __('Location') ?></td>
            <td><?= h($designator->location) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($designator->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Start Depth') ?></td>
            <td><?= $this->Number->format($designator->start_depth) ?></td>
        </tr>
        <tr>
            <td><?= __('End Depth') ?></td>
            <td><?= $this->Number->format($designator->end_depth) ?></td>
        </tr>
        <tr>
            <td><?= __('Latitude') ?></td>
            <td><?= $this->Number->format($designator->latitude) ?></td>
        </tr>
        <tr>
            <td><?= __('Longitude') ?></td>
            <td><?= $this->Number->format($designator->longitude) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($designator->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($designator->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= $this->Text->autoParagraph(h($designator->description)); ?></td>
        </tr>
    </table>
</div>

