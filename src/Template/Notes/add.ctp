<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li class="active">Create a new Note</li>
</ol>


<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($note) ?>
    <fieldset>
        <legend><?= __('Add Note') ?></legend>
        <?php
            echo $this->Form->input('body',['type'=>'textarea']);
            echo $this->Form->input('type',[
              'type'=>'radio',
              'options'=>['note'=>'Note','flag'=>'Flag'],
              'inline'=>true, 
              'label'=>false
            ]);
            echo $this->Form->input('redmine_issue');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
