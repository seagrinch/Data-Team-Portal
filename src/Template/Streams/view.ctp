<h2>Stream: <?= h($stream->name) ?></h2>


<dl class="dl-horizontal">
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($stream->id) ?></dd>
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
<?php if (!empty($stream->designators)): ?>
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
        <?php foreach ($stream->designators as $designators): ?>
            <tr>
                <td><?= $this->Html->link($designators->reference_designator,['controller'=>'designators','action'=>'view',$designators->reference_designator]) ?></td>
                <td><?= h($designators->name) ?></td>
                <td><?= h($designators->location) ?></td>
                <td><?= h($designators->start_depth) ?></td>
                <td><?= h($designators->end_depth) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="panel-body">No related Instruments</p>
<?php endif; ?>

