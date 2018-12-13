<?php $this->assign('title','Edit '.$instrument->reference_designator)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->name,['action'=>'view',$instrument->reference_designator]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($instrument) ?>
    <fieldset>
        <legend>Edit <?= h($instrument->name) ?></legend>
        <?php
            echo $this->Form->input('current_status', ['options'=>[
              'Engineering'=>'Engineering',
              'Camera'=>'Camera',
              'Todo'=>'Todo',
              'Will Not Review'=>'Will Not Review',
              'Blocked'=>'Review Blocked',
              'In Progress'=>'Review in Progress',
              'Complete'=>'Review Complete',
            ], 'empty'=>'Unknown', 'label'=>'Review Status']);
            echo $this->Form->control('note');
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'report', $instrument->reference_designator], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
