<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Nuggets'), ['action' => 'index']) ?></li>
  <li><?= $this->html->link($nugget->title,['action'=>'view',$nugget->id]) ?></li>
  <li class="active">Edit</li>
</ol>

<?= $this->Form->create($nugget) ?>
<fieldset>
  <legend>Edit Nugget</legend>

  <div class="row">
    <div class='col-md-5'>
      <?php
      echo $this->Form->control('title');
      echo $this->Form->input('start_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="start-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($nugget->start_date,'M/d/yyyy'),
        ]);
      echo $this->Form->input('end_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-th" id="end-date-dp"></span>',
        'value'=> $this->Time->i18nFormat($nugget->end_date,'M/d/yyyy'),
        ]);
      echo $this->Form->control('science_theme');
      echo $this->Form->control('science_concept');
      echo $this->Form->control('nextgen');
      echo $this->Form->control('difficulty');

      echo $this->Form->input('status',['label'=>'Status',
        'options'=>[
          'Todo'=>'Todo',
          'In Progress'=>'In Progress',
          'Complete'=>'Complete',
        ],'empty'=>true]);

      echo $this->Form->control('location');
      echo $this->Form->control('graph_link');
      echo $this->Form->control('notebook_link');
      echo $this->Form->control('data_link');
      ?>
    </div>
    <div class='col-md-7'>
      <?php
      echo $this->Form->control('instruments',['rows'=>12]);
      echo $this->Form->control('description',['rows'=>12]);
      ?>
      <div class="pull-right">
      <?= $this->Html->link('Cancel', ['action' => 'view', $nugget->id], ['class'=>'btn btn-default']); ?> 
      <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?> 
      </div>

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
