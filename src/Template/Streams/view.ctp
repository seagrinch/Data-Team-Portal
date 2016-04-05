<?php
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Stream'), ['action' => 'edit', $stream->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Stream'), ['action' => 'delete', $stream->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stream->id)]) ?> </li>
<li><?= $this->Html->link(__('List Streams'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Stream'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Designators'), ['controller' => 'Designators', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Designator'), ['controller' => 'Designators', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Stream'), ['action' => 'edit', $stream->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Stream'), ['action' => 'delete', $stream->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stream->id)]) ?> </li>
<li><?= $this->Html->link(__('List Streams'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Stream'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Designators'), ['controller' => 'Designators', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Designator'), ['controller' => 'Designators', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($stream->name) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($stream->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($stream->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Time Parameter') ?></td>
            <td><?= $this->Number->format($stream->time_parameter) ?></td>
        </tr>
        <tr>
            <td><?= __('Binsize Minutes') ?></td>
            <td><?= $this->Number->format($stream->binsize_minutes) ?></td>
        </tr>
        <tr>
            <td><?= __('Uses Ctd') ?></td>
            <td><?= $stream->uses_ctd ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Designators') ?></h3>
    </div>
    <?php if (!empty($stream->designators)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Reference Designator') ?></th>
                <th><?= __('Designator Type') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Location') ?></th>
                <th><?= __('Start Depth') ?></th>
                <th><?= __('End Depth') ?></th>
                <th><?= __('Latitude') ?></th>
                <th><?= __('Longitude') ?></th>
                <th><?= __('Parent Designator') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($stream->designators as $designators): ?>
                <tr>
                    <td><?= h($designators->id) ?></td>
                    <td><?= h($designators->reference_designator) ?></td>
                    <td><?= h($designators->designator_type) ?></td>
                    <td><?= h($designators->name) ?></td>
                    <td><?= h($designators->description) ?></td>
                    <td><?= h($designators->type) ?></td>
                    <td><?= h($designators->location) ?></td>
                    <td><?= h($designators->start_depth) ?></td>
                    <td><?= h($designators->end_depth) ?></td>
                    <td><?= h($designators->latitude) ?></td>
                    <td><?= h($designators->longitude) ?></td>
                    <td><?= h($designators->parent_designator) ?></td>
                    <td><?= h($designators->created) ?></td>
                    <td><?= h($designators->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Designators', 'action' => 'view', $designators->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Designators', 'action' => 'edit', $designators->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Designators', 'action' => 'delete', $designators->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designators->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Designators</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Parameters') ?></h3>
    </div>
    <?php if (!empty($stream->parameters)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Unit') ?></th>
                <th><?= __('Fill Value') ?></th>
                <th><?= __('Display Name') ?></th>
                <th><?= __('Standard Name') ?></th>
                <th><?= __('Precision') ?></th>
                <th><?= __('Parameter Function Id') ?></th>
                <th><?= __('Parameter Function Map') ?></th>
                <th><?= __('Data Product Identifier') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($stream->parameters as $parameters): ?>
                <tr>
                    <td><?= h($parameters->id) ?></td>
                    <td><?= h($parameters->name) ?></td>
                    <td><?= h($parameters->unit) ?></td>
                    <td><?= h($parameters->fill_value) ?></td>
                    <td><?= h($parameters->display_name) ?></td>
                    <td><?= h($parameters->standard_name) ?></td>
                    <td><?= h($parameters->precision) ?></td>
                    <td><?= h($parameters->parameter_function_id) ?></td>
                    <td><?= h($parameters->parameter_function_map) ?></td>
                    <td><?= h($parameters->data_product_identifier) ?></td>
                    <td><?= h($parameters->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Parameters', 'action' => 'view', $parameters->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Parameters', 'action' => 'edit', $parameters->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Parameters', 'action' => 'delete', $parameters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameters->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Parameters</p>
    <?php endif; ?>
</div>
