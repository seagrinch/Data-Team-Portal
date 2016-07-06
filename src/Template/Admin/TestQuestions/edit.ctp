<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Questions'), ['controller'=>'test-questions', 'action' => 'index']) ?></li>
  <li class="active">Edit #<?= h($testQuestion->id) ?></li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>
    
    <?= $this->Form->create($testQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Test Question') ?></legend>
        <?php
            echo $this->Form->input('question');
            echo $this->Form->input('type',['options' => [
                'instrument'=>'Instrument', 
                'stream'=>'Stream', 
                'parameter'=>'Parameter']]);
        ?>
    </fieldset>

		<?= $this->Html->link('Cancel', ['action' => 'index'], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
  <div class="col-md-3">
    <?= $this->Form->postLink(
        __('Delete Question'),
        ['action' => 'delete', $testQuestion->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $testQuestion->id), 'class'=>'btn btn-danger']
      )
    ?>
  </div>
</div>
