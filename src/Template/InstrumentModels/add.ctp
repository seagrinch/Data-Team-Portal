<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Instrument Models'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="instrumentModels form large-9 medium-8 columns content">
    <?= $this->Form->create($instrumentModel) ?>
    <fieldset>
        <legend><?= __('Add Instrument Model') ?></legend>
        <?php
            echo $this->Form->input('class');
            echo $this->Form->input('series');
            echo $this->Form->input('name');
            echo $this->Form->input('make');
            echo $this->Form->input('model');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
