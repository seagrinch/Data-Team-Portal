<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruise Reviews'), ['controller'=>'cruise_reviews', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($cruiseReview->cruise_cuid,['action'=>'view',$cruiseReview->cruise_cuid]) ?></li>
  <li class="active">Edit</li>
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
    <?= $this->Form->button(__('Create')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
