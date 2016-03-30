<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Designator'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="designators index large-9 medium-8 columns content">
    <h3><?= __('Designators') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('reference_designator') ?></th>
                <th><?= $this->Paginator->sort('designator_type') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('location') ?></th>
                <th><?= $this->Paginator->sort('start_depth') ?></th>
                <th><?= $this->Paginator->sort('end_depth') ?></th>
                <th><?= $this->Paginator->sort('latitude') ?></th>
                <th><?= $this->Paginator->sort('longitude') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($designators as $designator): ?>
            <tr>
                <td><?= $this->Number->format($designator->id) ?></td>
                <td><?= h($designator->reference_designator) ?></td>
                <td><?= h($designator->designator_type) ?></td>
                <td><?= h($designator->name) ?></td>
                <td><?= h($designator->type) ?></td>
                <td><?= h($designator->location) ?></td>
                <td><?= $this->Number->format($designator->start_depth) ?></td>
                <td><?= $this->Number->format($designator->end_depth) ?></td>
                <td><?= $this->Number->format($designator->latitude) ?></td>
                <td><?= $this->Number->format($designator->longitude) ?></td>
                <td><?= h($designator->created) ?></td>
                <td><?= h($designator->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $designator->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $designator->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $designator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
