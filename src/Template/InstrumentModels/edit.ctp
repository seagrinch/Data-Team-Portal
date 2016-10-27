<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Instrument Classes'), ['controller'=>'instrument_classes','action' => 'index']) ?></li>
  <li><?= $this->Html->link($instrument_model->class, ['controller'=>'instrument_classes','action' => 'view', $instrument_model->class]) ?></li>
  <li><?= $this->Html->link($instrument_model->class.'-'.$instrument_model->series, ['controller'=>'instrument_models','action' => 'view', $instrument_model->class, $instrument_model->series]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($instrument_model) ?>
    <fieldset>
        <legend>Edit <?= h($instrument_model->class) . '-' . $instrument_model->series ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('website_info');
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'view', $instrument_model->class,$instrument_model->series], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
