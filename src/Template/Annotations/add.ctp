<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Annotations'), ['controller'=>'annotations', 'action' => 'index']) ?></li>
  <li class="active">Create a new Annotation</li>
</ol>

<?= $this->Form->create($annotation) ?>
<fieldset>
  <legend>New <?=$annotation->type?></legend>

  <div class="row">
    <div class='col-md-6'>
      <dl class="dl-horizontal">
        <dt><?= __('Reference Designator') ?></dt>
        <dd><?= h($annotation->reference_designator) ?></dd>
        <dt><?= __('Method') ?></dt>
        <dd><?= h($annotation->method) ?></dd>
        <dt><?= __('Stream') ?></dt>
        <dd><?= h($annotation->stream) ?></dd>
        <dt><?= __('Parameter') ?></dt>
        <dd><?= h($annotation->parameter) ?></dd>
      </dl>
      
      <?php
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
      ?>
    </div>
    <div class='col-md-6'>
      <?php
      echo $this->Form->input('comment',['type'=>'textarea', 'rows'=>12]);
      if (in_array($annotation->type, ['issue', 'note'])) {
        echo $this->Form->input('redmine_issue',['label'=>[
          'text'=>'Redmine Issue <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Redmine issue number."></span>', 
          'escape'=>false] ]);
      }
      if ($annotation->type=='annotation') {
        echo $this->Form->input('exclusion_flag',['label'=>'Exclude Data?']);
      }
      ?>

      <?= $this->Html->link('Cancel', ['controller'=>$annotation->model, 'action' => 'view', $annotation->reference_designator, '#'=>'annotations'], ['class'=>'btn btn-default']); ?> 
      <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?> 

    </div>
  </div>
</fieldset>
    
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
<?php $this->Html->scriptEnd(); ?>
