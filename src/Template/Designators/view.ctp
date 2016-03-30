<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Designator'), ['action' => 'edit', $designator->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Designator'), ['action' => 'delete', $designator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Designator'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="designators view large-9 medium-8 columns content">
    <h3><?= h($designator->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Reference Designator') ?></th>
            <td><?= h($designator->reference_designator) ?></td>
        </tr>
        <tr>
            <th><?= __('Designator Type') ?></th>
            <td><?= h($designator->designator_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($designator->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($designator->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= h($designator->location) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($designator->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Depth') ?></th>
            <td><?= $this->Number->format($designator->start_depth) ?></td>
        </tr>
        <tr>
            <th><?= __('End Depth') ?></th>
            <td><?= $this->Number->format($designator->end_depth) ?></td>
        </tr>
        <tr>
            <th><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($designator->latitude) ?></td>
        </tr>
        <tr>
            <th><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($designator->longitude) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($designator->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($designator->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($designator->description)); ?>
    </div>
</div>
