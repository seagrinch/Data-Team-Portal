<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'view',$site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($site->name,['action'=>'view',$site->reference_designator]) ?></li>
  <li class="active">Edit</li>
</ol>


<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($site) ?>
    <fieldset>
        <legend>Edit <?= h($site->name) ?></legend>
        <?php
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('bottom_depth');
            echo $this->Form->input('current_status',['options'=>['deployed'=>'Deployed','recovered'=>'Recovered',''=>'Unknown']]);
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'view', $site->reference_designator], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
