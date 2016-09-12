<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li><?= $this->html->link('Note #' . $note->id,['action'=>'view',$note->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<?= $this->Form->create($note) ?>
<fieldset>
  <legend><?= __('Edit Note') ?></legend>

  <div class="row">
    <div class='col-md-6'>
      <strong>Note Type</strong> <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="A Flag is an issue that can be resolved. An Operational or Data Quality note is a permanent known problem that cannot be resolved until the instrument is redeployed or replaced."></span>
      <?php
      echo $this->Form->input('type',[
        'type'=>'radio',
        'options'=>['note'=>'Operational Note','data'=>'Data Quality','flag'=>'Flag/Issue','resolved'=>'Resolved Flag'],
        'inline'=>true,
        'label'=>false
      ]);
      echo $this->Form->input('comment',['type'=>'textarea', 'rows'=>12]);
      ?>
    </div>
    <div class='col-md-6'>
      <?php
      echo $this->Form->input('reference_designator',['disabled'=>true]);
      echo $this->Form->input('deployment',['label'=>[
        'text'=>'Deployment <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the deployment number."></span>', 
        'escape'=>false] ] );
      echo $this->Form->input('start_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
        ]);
      echo $this->Form->input('end_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
        ]);
      echo $this->Form->input('redmine_issue',['label'=>[
        'text'=>'Redmine Issue <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Redmine issue number."></span>', 
        'escape'=>false] ]);
      echo $this->Form->input('resolved_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="resolved-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($note->resolved_date,'M/d/yyyy'),
        'empty' => true
        ]);
      echo $this->Form->input('resolved_comment');
      ?>
    </div>
  </div>
</fieldset>
    
<?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator], ['class'=>'btn btn-default']); ?> 
<?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?> 
<?= $this->Form->end() ?>

<?php $this->Html->css('datepicker/bootstrap-datepicker3',['block'=>true]); ?>
<?php $this->Html->script('datepicker/bootstrap-datepicker',['block'=>true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

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