<h3>OOI Streams</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('display_name'); ?></th>
            <th><?= $this->Paginator->sort('stream_type'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($streams as $stream): ?>
        <tr>
            <td><?= $this->Number->format($stream->id,['pattern'=>'#']) ?></td>
            <td><?= $this->Html->link($stream->name,['action'=>'view',$stream->name]) ?></td>
            <td><?= h($stream->display_name) ?></td>
            <td><?= h($stream->stream_type) ?></td>
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