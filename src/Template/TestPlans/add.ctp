<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li class="active">Create a Test Plan</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>
    
    <?= $this->Form->create($testPlan) ?>
    <fieldset>
        <legend><?= __('Create a new Test Plan') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

  </div>
</div>
