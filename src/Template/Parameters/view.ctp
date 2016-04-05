<?php
$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
<li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Parameter Functions'), ['controller' => 'ParameterFunctions', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter Function'), ['controller' => 'ParameterFunctions', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
<li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Parameter Functions'), ['controller' => 'ParameterFunctions', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Parameter Function'), ['controller' => 'ParameterFunctions', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($parameter->name) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($parameter->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Unit') ?></td>
            <td><?= h($parameter->unit) ?></td>
        </tr>
        <tr>
            <td><?= __('Fill Value') ?></td>
            <td><?= h($parameter->fill_value) ?></td>
        </tr>
        <tr>
            <td><?= __('Display Name') ?></td>
            <td><?= h($parameter->display_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Standard Name') ?></td>
            <td><?= h($parameter->standard_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Precision') ?></td>
            <td><?= h($parameter->precision) ?></td>
        </tr>
        <tr>
            <td><?= __('Parameter Function') ?></td>
            <td><?= $parameter->has('parameter_function') ? $this->Html->link($parameter->parameter_function->name, ['controller' => 'ParameterFunctions', 'action' => 'view', $parameter->parameter_function->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Data Product Identifier') ?></td>
            <td><?= h($parameter->data_product_identifier) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($parameter->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Parameter Function Map') ?></td>
            <td><?= $this->Text->autoParagraph(h($parameter->parameter_function_map)); ?></td>
        </tr>
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= $this->Text->autoParagraph(h($parameter->description)); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Streams') ?></h3>
    </div>
    <?php if (!empty($parameter->streams)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Time Parameter') ?></th>
                <th><?= __('Uses Ctd') ?></th>
                <th><?= __('Binsize Minutes') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($parameter->streams as $streams): ?>
                <tr>
                    <td><?= h($streams->id) ?></td>
                    <td><?= h($streams->name) ?></td>
                    <td><?= h($streams->time_parameter) ?></td>
                    <td><?= h($streams->uses_ctd) ?></td>
                    <td><?= h($streams->binsize_minutes) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Streams', 'action' => 'view', $streams->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Streams', 'action' => 'edit', $streams->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Streams', 'action' => 'delete', $streams->id], ['confirm' => __('Are you sure you want to delete # {0}?', $streams->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Streams</p>
    <?php endif; ?>
</div>
