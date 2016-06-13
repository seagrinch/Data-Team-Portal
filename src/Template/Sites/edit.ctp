<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $site->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $site->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sites'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="sites form large-9 medium-8 columns content">
    <?= $this->Form->create($site) ?>
    <fieldset>
        <legend><?= __('Edit Site') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('region');
            echo $this->Form->input('array_name');
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('bottom_depth');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
