<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $designator->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $designator->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Designators'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="designators form large-9 medium-8 columns content">
    <?= $this->Form->create($designator) ?>
    <fieldset>
        <legend><?= __('Edit Designator') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('designator_type');
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('type');
            echo $this->Form->input('location');
            echo $this->Form->input('start_depth');
            echo $this->Form->input('end_depth');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
