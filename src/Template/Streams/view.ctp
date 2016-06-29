<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Streams'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($stream->name) ?></li>
</ol>

<h2>Stream: <?= h($stream->name) ?></h2>


<dl class="dl-horizontal">
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($stream->id) ?></dd>
  <dt><?= __('Display Name') ?></dt>
  <dd><?= h($stream->display_name) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= h($stream->description) ?></dd>
  <dt><?= __('Stream Type') ?></dt>
  <dd><?= h($stream->stream_type) ?></dd>
  <dt><?= __('Time Parameter') ?></dt>
  <dd><?= $this->Number->format($stream->time_parameter) ?></dd>
  <dt><?= __('Binsize Minutes') ?></dt>
  <dd><?= $this->Number->format($stream->binsize_minutes) ?></dd>
  <dt><?= __('Uses Ctd') ?></dt>
  <dd><?= $stream->uses_ctd ? __('Yes') : __('No'); ?></dd>
</dl>


<h3><?= __('Related Parameters') ?></h3>
<?php if (!empty($stream->parameters)): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Display Name') ?></th>
            <th><?= __('Standard Name') ?></th>
            <th><?= __('Unit') ?></th>
            <th><?= __('Fill Value') ?></th>
            <th><?= __('Precision') ?></th>
            <th><?= __('Data Product Identifier') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($stream->parameters as $parameters): ?>
            <tr>
                <td>PD<?= h($parameters->id) ?></td>
                <td><?= $this->Html->link($parameters->name,['controller'=>'parameters','action'=>'view',$parameters->id]) ?></td>
                <td><?= h($parameters->unit) ?></td>
                <td><?= h($parameters->fill_value) ?></td>
                <td><?= h($parameters->display_name) ?></td>
                <td><?= h($parameters->standard_name) ?></td>
                <td><?= h($parameters->precision) ?></td>
                <td><?= h($parameters->data_product_identifier) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="panel-body">no related Parameters</p>
<?php endif; ?>


<h3><?= __('Related Instruments') ?></h3>
<?php if (!empty($stream->data_streams)): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?= __('Reference Designator') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Location') ?></th>
            <th><?= __('Start Depth') ?></th>
            <th><?= __('End Depth') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($stream->data_streams as $instrument): ?>
            <tr>
                <td><?= $this->Html->link($instrument->reference_designator,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?></td>
                <td><?= h($instrument->instrument->name) ?></td>
                <td><?= h($instrument->instrument->location) ?></td>
                <td><?= h($instrument->instrument->start_depth) ?></td>
                <td><?= h($instrument->instrument->end_depth) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="panel-body">No related Instruments</p>
<?php endif; ?>

