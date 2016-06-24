<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li><?= $this->html->link('Note #' . $note->id,['action'=>'view',$note->id]) ?></li>
  <li class="active">Edit</li>
</ol>


<div class="row">
  <div class='col-md-8 col-md-offset-2'>

    <?= $this->Form->create($note) ?>
    <fieldset>
        <legend><?= __('Edit Note') ?></legend>
        <?php
            echo $this->Form->input('body', ['type'=>'textarea', 'rows'=>12]);
            echo $this->Form->input('type',[
              'type'=>'radio',
              'options'=>['note'=>'Note','flag'=>'Flag'],
              'inline'=>true, 
              'label'=>false
            ]);
            echo $this->Form->input('redmine_issue');
            echo $this->Form->input('resolved', ['empty' => true]);
            echo $this->Form->input('resolved_comment');
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>
