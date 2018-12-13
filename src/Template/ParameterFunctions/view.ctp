<?php $this->assign('title',$parameterFunction->name)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Parameter Functions'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($parameterFunction->name) ?></li>
</ol>

<h3><?= h($parameterFunction->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Function Type') ?></dt>
  <dd><?= h($parameterFunction->function_type) ?></dd>
  <dt><?= __('Function') ?></dt>
  <dd><?= h($parameterFunction->function) ?></dd>
  <dt><?= __('Owner') ?></dt>
  <dd><?= h($parameterFunction->owner) ?></dd>
  <dt><?= __('Qc Flag') ?></dt>
  <dd><?= h($parameterFunction->qc_flag) ?></dd>
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($parameterFunction->id) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($parameterFunction->description)); ?></dd>
</dl>

<h4><?= __('Related Parameters') ?></h4>
<?php if (!empty($parameterFunction->parameters)): ?>
<table class="table table-striped">
    <tr>
        <th><?= __('Id') ?></th>
        <th><?= __('Name') ?></th>
    </tr>
    <?php foreach ($parameterFunction->parameters as $parameters): ?>
    <tr>
        <td><?= h($parameters->id) ?></td>
        <td><?= $this->Html->link($parameters->name, ['controller' => 'Parameters', 'action' => 'view', $parameters->id]) ?>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
