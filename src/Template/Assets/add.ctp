<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="assets form large-9 medium-8 columns content">
    <?= $this->Form->create($asset) ?>
    <fieldset>
        <legend><?= __('Add Asset') ?></legend>
        <?php
            echo $this->Form->input('ooi_barcode');
            echo $this->Form->input('description_of_equipment');
            echo $this->Form->input('quant');
            echo $this->Form->input('manufacturer');
            echo $this->Form->input('model');
            echo $this->Form->input('manufacturer_serial_no');
            echo $this->Form->input('firmware_version');
            echo $this->Form->input('source_of_the_equipment');
            echo $this->Form->input('whether_title');
            echo $this->Form->input('location');
            echo $this->Form->input('room_number');
            echo $this->Form->input('condition');
            echo $this->Form->input('acquisition_date');
            echo $this->Form->input('original_cost');
            echo $this->Form->input('federal_participation');
            echo $this->Form->input('comments');
            echo $this->Form->input('primary_tag_date');
            echo $this->Form->input('primary_tag_organization');
            echo $this->Form->input('primary_institute_asset_tag');
            echo $this->Form->input('secondary_tag_date');
            echo $this->Form->input('second_tag_organization');
            echo $this->Form->input('institute_asset_tag');
            echo $this->Form->input('doi_tag_date');
            echo $this->Form->input('doi_tag_organization');
            echo $this->Form->input('doi_institute_asset_tag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
