<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cruises'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cruises form large-9 medium-8 columns content">
    <?= $this->Form->create($cruise) ?>
    <fieldset>
        <legend><?= __('Add Cruise') ?></legend>
        <?php
            echo $this->Form->input('cuid');
            echo $this->Form->input('ship_name');
            echo $this->Form->input('cruise_start_date', ['empty' => true]);
            echo $this->Form->input('cruise_end_date', ['empty' => true]);
            echo $this->Form->input('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
