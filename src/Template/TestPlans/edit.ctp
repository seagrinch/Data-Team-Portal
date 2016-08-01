<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Plans'), ['controller'=>'test-plans', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($testPlan->name . ' (#' . $this->Number->format($testPlan->id) . ')' , ['controller'=>'test-plans', 'action' => 'view', $testPlan->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<div class="row">
  <div class='col-md-6 col-md-offset-3'>

    <?= $this->Form->create($testPlan) ?>
    <fieldset>
        <legend><?= __('Edit Test Plan') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('status',['options' => [
                'Draft'=>'Draft', 
                'In Progress'=>'In Progress', 
                'Completed'=>'Completed']]);
            echo $this->Form->input('start_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($testPlan->start_date,'M/d/yyyy')
              ]);
            echo $this->Form->input('end_date',[
              'type'=>'text',
              'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
              'value'=> $this->Time->i18nFormat($testPlan->end_date,'M/d/yyyy')
              ]);
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
		<?= $this->Html->link('Cancel', ['action' => 'view', $testPlan->id], ['class'=>'btn btn-default']); ?>
    <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    
  </div>
  <div class="col-md-3">
    <?= $this->Form->postLink(
        __('Delete Test Plan'),
        ['action' => 'delete', $testPlan->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $testPlan->id), 'class'=>'btn btn-danger']
      )
    ?>
  </div>
</div>
