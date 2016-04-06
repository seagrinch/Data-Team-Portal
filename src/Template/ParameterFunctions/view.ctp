<h2>Parameter Function: <?= h($parameterFunction->name) ?></h2>

<dl class="dl-horizontal">
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($parameterFunction->id) ?></dd>
  <dt><?= __('Function Type') ?></dt>
  <dd><?= h($parameterFunction->function_type) ?></dd>
  <dt><?= __('Function') ?></dt>
  <dd><?= h($parameterFunction->function) ?></dd>
  <dt><?= __('Owner') ?></dt>
  <dd><?= h($parameterFunction->owner) ?></dd>
  <dt><?= __('Qc Flag') ?></dt>
  <dd><?= h($parameterFunction->qc_flag) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($parameterFunction->description)); ?></dd>
</dl>


<h3><?= __('Related Parameters') ?></h3>
<?php if (!empty($parameterFunction->parameters)): ?>
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
        <?php foreach ($parameterFunction->parameters as $parameters): ?>
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
    <p class="panel-body">No related Parameters</p>
<?php endif; ?>
