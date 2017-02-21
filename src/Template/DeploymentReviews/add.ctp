<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Deployment Reviews'), ['controller'=>'deployment_reviews', 'action' => 'index']) ?></li>
  <li class="active">Add New</li>
</ol>

<div class="row">
  <div class="col-md-4">
    
    <?= $this->Form->create($deploymentReview) ?>
    <fieldset>
        <legend><?= __('Crate a new Deployment Review') ?></legend>
        <?php
            echo $this->Form->input('reference_designator');
            echo $this->Form->input('deployment_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Create'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
