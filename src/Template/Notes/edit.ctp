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
            echo $this->Form->input('comment', ['type'=>'textarea', 'rows'=>12]);
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
              'value'=> $this->Time->i18nFormat($note->start_date,'M/d/yyyy')
              ]);
            echo $this->Form->input('end_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($note->end_date,'M/d/yyyy')
              ]);
            echo $this->Form->input('redmine_issue');
            echo $this->Form->input('resolved_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="resolved-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($note->resolved_date,'M/d/yyyy'),
              'empty' => true
              ]);
            echo $this->Form->input('resolved_comment');
        ?>
    </fieldset>
    
		<?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
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
  $('#resolved-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#resolved-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#resolved-date').datepicker('show');
    });
<?php $this->Html->scriptEnd(); ?>