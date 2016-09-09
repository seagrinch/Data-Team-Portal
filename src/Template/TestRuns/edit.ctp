<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Runs'), ['controller'=>'test-runs', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($testRun->name . ' (#' . $this->Number->format($testRun->id) . ')' , ['controller'=>'test-runs', 'action' => 'view', $testRun->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($testRun) ?>
    <fieldset>
        <legend><?= __('Edit Test Run') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('reference_designator',['disabled'=>true]);
            echo $this->Form->input('deployment');
            echo $this->Form->input('start_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($testRun->start_date,'M/d/yyyy')
              ]);
            echo $this->Form->input('end_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($testRun->end_date,'M/d/yyyy')
              ]);
            echo $this->Form->input('status',['options' => [
                'Draft'=>'Draft', 
                'Blocked'=>'Testing Blocked',
                'In Progress'=>'Testing In Progress', 
                'Awaiting Fixes'=>'Awaiting Data Fixes', 
                'Completed'=>'Completed / Good to Go']]);
            echo $this->Form->input('comment');
        ?>
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

    </fieldset>
		<?= $this->Html->link('Cancel', ['action' => 'view', $testRun->id], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
  <div class="col-md-3">
    <?= $this->Form->postLink(
        __('Delete Test Run'),
        ['action' => 'delete', $testRun->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $testRun->id), 'class'=>'btn btn-danger']
      )
    ?>
  </div>
</div>
