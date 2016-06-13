<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Data Streams'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($dataStream->id) ?></li>
</ol>

<h3><?= h($dataStream->id) ?></h3>
<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($dataStream->reference_designator) ?></dd>
  <dt><?= __('Instrument') ?></dt>
  <dd><?= $dataStream->has('instrument') ? $this->Html->link($dataStream->instrument->name, ['controller' => 'Instruments', 'action' => 'view', $dataStream->instrument->id]) : '' ?></dd>
  <dt><?= __('Method') ?></dt>
  <dd><?= h($dataStream->method) ?></dd>
  <dt><?= __('Stream Name') ?></dt>
  <dd><?= h($dataStream->stream_name) ?></dd>
  <dt><?= __('Stream') ?></dt>
  <dd><?= $dataStream->has('stream') ? $this->Html->link($dataStream->stream->name, ['controller' => 'Streams', 'action' => 'view', $dataStream->stream->id]) : '' ?></dd>
  <dt><?= __('Uframe Route') ?></dt>
  <dd><?= h($dataStream->uframe_route) ?></dd>
  <dt><?= __('Driver') ?></dt>
  <dd><?= h($dataStream->driver) ?></dd>
  <dt><?= __('Parser') ?></dt>
  <dd><?= h($dataStream->parser) ?></dd>
  <dt><?= __('Instrument Type') ?></dt>
  <dd><?= h($dataStream->instrument_type) ?></dd>
  <dt><?= __('Id') ?></dt>
  <dd><?= $this->Number->format($dataStream->id) ?></dd>
</dl>