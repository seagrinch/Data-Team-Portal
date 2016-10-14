<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruises'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($cruise->cuid) ?></li>
</ol>

<h2>Cruise: <?= h($cruise->cuid) ?></h2>

<dl class="dl-horizontal">
  <dt><?= __('Ship Name') ?></dt>
  <dd><?= h($cruise->ship_name) ?></dd>
  <dt><?= __('Cruise Start Date') ?></dt>
  <dd><?= h($cruise->cruise_start_date) ?></dd>
  <dt><?= __('Cruise End Date') ?></dt>
  <dd><?= h($cruise->cruise_end_date) ?></dd>
  <dt><?= __('Notes') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($cruise->notes)); ?></dd>
</dl>
