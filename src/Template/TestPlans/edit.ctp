<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($testPlan->name . ' (#' . $this->Number->format($testPlan->id) . ')' , ['controller'=>'test-plans', 'action' => 'view', $testPlan->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($testPlan) ?>
    <fieldset>
        <legend><?= __('Edit Test Plan') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('status',['options' => [
                'Draft'=>'Draft', 
                'In Progress'=>'In Progress', 
                'Completed'=>'Completed']]);
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'view', $testPlan->id], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
  <div class="col-md-3">
    <?= $this->Form->postLink(
        __('Delete Test Plan'),
        ['action' => 'delete', $testPlan->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $testPlan->id), 'class'=>'btn btn-danger']
      )
    ?>
  </div>
</div>
