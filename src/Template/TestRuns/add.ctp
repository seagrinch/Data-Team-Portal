<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Runs'), ['controller'=>'test-runs', 'action' => 'index']) ?></li>
  <li class="active">Create a Test Run</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>
    
    <?= $this->Form->create($testRun) ?>
    <fieldset>
        <legend><?= __('Create a new Test Run') ?></legend>
        <?php
            echo $this->Form->input('reference_designator', ['disabled'=>true]);
            echo $this->Form->input('name');
            echo $this->Form->input('deployment');
            echo $this->Form->input('start_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
              ]);
            echo $this->Form->input('end_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
              ]);
        ?>
    </fieldset>
		<?= $this->Html->link('Cancel', ['controller'=>'instruments', 'action' => 'view', $testRun->reference_designator], ['class'=>'btn btn-default']); ?>
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