<h3>OOI Parameters</h3>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('display_name'); ?></th>
            <th><?= $this->Paginator->sort('standard_name'); ?></th>
            <th><?= $this->Paginator->sort('unit'); ?></th>
            <th><?= $this->Paginator->sort('fill_value'); ?></th>
            <th><?= $this->Paginator->sort('precision'); ?></th>
            <th><?= $this->Paginator->sort('data_product_identifier'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parameters as $parameter): ?>
        <tr>
            <td>PD<?= $this->Number->format($parameter->id) ?></td>
            <td><?= $this->Html->link($parameter->name,['action'=>'view',$parameter->id]) ?></td>
            <td><?= h($parameter->display_name) ?></td>
            <td><?= h($parameter->standard_name) ?></td>
            <td><?= h($parameter->unit) ?></td>
            <td><?= h($parameter->fill_value) ?></td>
            <td><?= h($parameter->precision) ?></td>
            <td><?= h($parameter->data_product_identifier) ?></td>
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
