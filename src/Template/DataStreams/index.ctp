<h3>OOI Data Streams</h3>
<table class="table table-striped table-condensed" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('method') ?></th>
      <th><?= $this->Paginator->sort('stream_name') ?></th>
      <th><?= $this->Paginator->sort('stream_content') ?></th>
      <th><?= $this->Paginator->sort('description') ?></th>
      <th><?= $this->Paginator->sort('stream_type') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataStreams as $dataStream): ?>
    <tr>
      <td><?= $dataStream->has('instrument') ? $this->Html->link($dataStream->reference_designator, ['controller' => 'Instruments', 'action' => 'view', $dataStream->instrument->reference_designator]) : '' ?></td>
      <td><?= h($dataStream->method) ?></td>
      <td><?= $dataStream->has('stream') ? $this->Html->link($dataStream->stream->name, ['controller' => 'Streams', 'action' => 'view', $dataStream->stream->name]) : '' ?></td>
      <td><?= h($dataStream->stream->stream_content) ?></td>
      <td><?= h($dataStream->stream->description) ?></td>
      <td><?= h($dataStream->stream->stream_type) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('first')) ?>
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
    <?= $this->Paginator->last(__('last') . ' >>') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
