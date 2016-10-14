<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Assets'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($asset->asset_uid) ?></li>
</ol>

<h3>Asset: <?= h($asset->asset_uid) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Type') ?></dt>
  <dd><?= h($asset->type) ?></dd>
  <dt><?= __('Mobile') ?></dt>
  <dd><?= h($asset->mobile) ?></dd>
  <dt><?= __('Description of Equipment') ?></dt>
  <dd><?= h($asset->description_of_equipment) ?></dd>
  <dt><?= __('Manufacturer') ?></dt>
  <dd><?= h($asset->manufacturer) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($asset->model) ?></dd>
  <dt><?= __('Manufacturer Serial No') ?></dt>
  <dd><?= h($asset->manufacturer_serial_no) ?></dd>
  <dt><?= __('Firmware Version') ?></dt>
  <dd><?= h($asset->firmware_version) ?></dd>
  <dt><?= __('Acquisition Date') ?></dt>
  <dd><?= h($asset->acquisition_date) ?></dd>
  <dt><?= __('Original Cost') ?></dt>
  <dd><?= $this->Number->currency($asset->original_cost) ?></dd>
  <dt><?= __('Comments') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($asset->comments)); ?></dd>
</dl>
