<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruise Reviews'), ['controller'=>'cruise_reviews', 'action' => 'index']) ?></li>
  <li class="active">Add New</li>
</ol>

<div class="row">
  <div class="col-md-4">
    
    <?= $this->Form->create($cruiseReview) ?>
    <fieldset>
        <legend><?= __('Crate a new Cruise Review') ?></legend>
        <?php
            echo $this->Form->input('cruise_cuid');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Create'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
