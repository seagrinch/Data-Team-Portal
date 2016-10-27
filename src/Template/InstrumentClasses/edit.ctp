<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['action' => 'index']) ?></li>
  <li><?= $this->Html->link($instrument_class->class, ['action' => 'view',$instrument_class->class]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($instrument_class) ?>
    <fieldset>
        <legend>Edit <?= h($instrument_class->class) ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('website_info');
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'view', $instrument_class->class], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
