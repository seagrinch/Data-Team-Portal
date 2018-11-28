<h3>Nodes</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('Site.array_name','Array Name') ?></th>
      <th><?= $this->Paginator->sort('Site.name') ?></th>
      <th><?= $this->Paginator->sort('name',['label'=>'Node Name']) ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($nodes as $node): ?>
    <tr>
      <td><?= $this->html->link($node->reference_designator,['action'=>'view',$node->reference_designator]) ?> 
      <td><?= h($node->site->array_name) ?></td>
      <td><?= h($node->site->name) ?></td>
      <td><?= h($node->name) ?></td>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
