<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li class="active">Create a new Note</li>
</ol>

<?php 
  $deployments =[];
  foreach ($note->deployments as $d) {
    $deployments[$d['deployment_number']] = [
      'asset_uid'  => $d['sensor_uid'],
      'start_date' => ($d['start_date'] ? $this->Time->format($d['start_date'], 'MM/dd/yyyy') : ''),
      'end_date'   => ($d['stop_date'] ? $this->Time->format($d['stop_date'], 'MM/dd/yyyy') : ''),
    ];
  }    
?>

<?= $this->Form->create($note) ?>
<fieldset>
  <legend>New Note</legend>

  <div class="row">
    <div class='col-md-6'>
      <dl class="dl-horizontal">
        <dt><?= __('Reference Designator') ?></dt>
        <dd><?= h($note->reference_designator) ?></dd>
      </dl>
      
      <?php
      //use Cake\Utility\Hash;
      echo $this->Form->input('deployment',[
        //'label'=>[
        //  'text'=>'Deployment <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the deployment number."></span>',
        //  'escape'=>false
        //],
        //'options'=>$deployments,
        //'options'=>Hash::combine($note->deployments, '{n}.deployment_number', 
        //  ['%s: %s to %s','{n}.deployment_number','{n}.start_date','{n}.stop_date']),
        'empty'=>true,
        'type'=>'select' ] );
      echo $this->Form->input('asset_uid',['label'=>[
        'text'=>'Asset ID <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Asset UID."></span>', 
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
      echo $this->Form->input('redmine_issue',['label'=>[
        'text'=>'Redmine Issue <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Redmine issue number."></span>', 
        'escape'=>false] ]);
      echo $this->Form->input('status',['label'=>'Status',
        'options'=>[
          'Available'=>'Available',
          'Not Operational'=>'Not Operational',
          'Failed'=>'Failed',
          'Open Issue'=>'Open Issue',
          'Resolved'=>'Resolved Issue',
        ],'empty'=>true]);
      ?>

      <?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator, '#'=>'notes'], ['class'=>'btn btn-default']); ?> 
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

  var deployments = <?= json_encode($deployments)?>;
  var mySelect = $('#deployment');
  $.each(deployments, function(i, item) {
    mySelect.append(
        $('<option></option>').val(i).html(i + ': ' + item.start_date + ' to ' + item.end_date)
    );
  });
  mySelect.on('change', function () {
    asset = (this.value) ? deployments[this.value].asset_uid : '';
    $('#asset-uid').val(asset);
  })
  
<?php $this->Html->scriptEnd(); ?>
