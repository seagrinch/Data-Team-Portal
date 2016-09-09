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
            echo $this->Form->input('comment',['type'=>'textarea', 'rows'=>12]);
            echo $this->Form->input('type',[
              'type'=>'radio',
              'options'=>['note'=>'Note','flag'=>'Flag'],
              'inline'=>true, 
              'label'=>false
            ]);
            echo $this->Form->input('deployment');
            echo $this->Form->input('start_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
              ]);
            echo $this->Form->input('end_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
              ]);
            echo $this->Form->input('redmine_issue');
        ?>
    </fieldset>
    
		<?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
</div>

<?php $this->Html->css('datepicker/bootstrap-datepicker3',['block'=>true]); ?>
<?php $this->Html->script('datepicker/bootstrap-datepicker',['block'=>true]); ?>
<?php $this->Html->scriptStart(['block' => true]); ?>
  $('#start-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#start-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#start-date').datepicker('show');
    });
  $('#end-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#end-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#end-date').datepicker('show');
    });
<?php $this->Html->scriptEnd(); ?>