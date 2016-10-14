<h3>OOI Parameters</h3>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('display_name'); ?></th>
            <th><?= $this->Paginator->sort('standard_name'); ?></th>
            <th><?= $this->Paginator->sort('unit'); ?></th>
            <th><?= $this->Paginator->sort('data_product_identifier'); ?></th>
            <th><?= $this->Paginator->sort('data_product_type'); ?></th>
            <th><?= $this->Paginator->sort('data_level'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parameters as $parameter): ?>
        <tr>
            <td>PD<?= $this->Number->format($parameter->id,['pattern'=>'#']) ?></td>
            <td><?= $this->Html->link($parameter->name,['action'=>'view',$parameter->id]) ?></td>
            <td><?= h($parameter->display_name) ?></td>
            <td><?= h($parameter->standard_name) ?></td>
            <td><?= h($parameter->unit) ?></td>
            <td><?= h($parameter->data_product_identifier) ?></td>
            <td><?= h($parameter->data_product_type) ?></td>
            <td><?= h($parameter->data_level) ?></td>
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
