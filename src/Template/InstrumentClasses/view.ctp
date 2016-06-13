<h3>Instrument Class: <?= h($instrumentClass->class) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Class') ?></dt>
  <dd><?= h($instrumentClass->class) ?></dd>
  <dt><?= __('Name') ?></dt>
  <dd><?= h($instrumentClass->name) ?></dd>
  <dt><?= __('Primary Science Dicipline') ?></dt>
  <dd><?= h($instrumentClass->primary_science_dicipline) ?></dd>
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($instrumentClass->id) ?></dd>
  <dt><?= __('Created') ?></dt>
  <dd><?= h($instrumentClass->created) ?></dd>
  <dt><?= __('Modified') ?></dt>
  <dd><?= h($instrumentClass->modified) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($instrumentClass->description)); ?></dd>
</dl>