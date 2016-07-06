<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Questions'), ['controller'=>'test-questions', 'action' => 'index']) ?></li>
  <li class="active">Add Test Question</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($testQuestion) ?>
    <fieldset>
        <legend><?= __('Add Test Question') ?></legend>
        <?php
            echo $this->Form->input('question');
            echo $this->Form->input('type',['options' => [
                'instrument'=>'Instrument', 
                'stream'=>'Stream', 
                'parameter'=>'Parameter']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
