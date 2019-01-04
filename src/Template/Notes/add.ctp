<?php $this->assign('title','Add Note')?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li class="active">Create a new Note</li>
  
</ol>

<?php 
  $deployments =[];
  foreach ($note->deployments as $d) {
    $deployments[$d['deployment_number']] = [
      'asset_uid'  => $d['sensor_uid'],
      'start_date' => ($d['start_date'] ? $this->Time->format($d['start_date'], 'MM/dd/yyyy HH:mm') : ''),
      'end_date'   => ($d['stop_date'] ? $this->Time->format($d['stop_date'], 'MM/dd/yyyy HH:mm') : ''),
    ];
  }    
?>

<?= $this->Form->create($note) ?>
<fieldset>
  <legend>New Note</legend>
  
    <dl class="dl-horizontal">
      <dt>Reference Designator:</dt>
      <dd><?= h($note->reference_designator) ?></dd>
    </dl>

  <div class="row">
    <div class='col-md-5'>      
      <?php
      echo $this->Form->input('type',['label'=>'Note Type',
        'options'=>[
          'draft'=>'Draft',
          'annotation'=>'Annotation',
          'exclusion'=>'Exclusion',
          'comment'=>'Comment',
        ],'empty'=>true]);
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
/*
      echo $this->Form->input('asset_uid','label'=>[
        'text'=>'Asset ID <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Asset UID. This will automatically update based on the selected deployment."></span>', 
        'escape'=>false] ] );
*/
      echo $this->Form->input('start_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-calendar" id="start-date-dp"></span>',
        ]);
      echo $this->Form->input('end_date',[
        'type'=>'text',
        'append' => '<span class="glyphicon glyphicon-calendar" id="end-date-dp"></span>',
        ]);
      echo $this->Form->input('image_url',['label'=>'Image URL']);
      ?>
    </div>
    <div class='col-md-7'>
      <?php
      echo $this->Form->input('comment',['type'=>'textarea', 'rows'=>12]);
/*
      echo $this->Form->input('redmine_issue',['label'=>[
        'text'=>'Redmine Issue <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Enter just the Redmine issue number."></span>', 
        'escape'=>false] ]);
      echo $this->Form->input('status',['label'=>'Status',
        'options'=>[
          'Available'=>'Available',
          'Not Operational'=>'Not Operational',
          'Not Available'=>'Not Available',
          'Pending Ingest'=>'Pending Ingest',
          'Not Evaluated'=>'Not Evaluated',
          'Suspect'=>'Suspect',
          'Failed'=>'Failed',
          'Pass'=>'Pass',
        ],'empty'=>true]);
*/
      ?>

      <?= $this->Html->link('Cancel', ['controller'=>$note->model, 'action' => 'view', $note->reference_designator, '#'=>'notes'], ['class'=>'btn btn-default']); ?> 
      <?= $this->Form->button(__('Save'),['class'=>'btn btn-primary']) ?> 

    </div>
  </div>
</fieldset>
    
<?= $this->Form->end() ?>

<?php $this->Html->css('datetimepicker/bootstrap-datetimepicker',['block'=>true]); ?>
<?php $this->Html->script('moment',['block'=>true]); ?>
<?php $this->Html->script('datetimepicker/bootstrap-datetimepicker.min',['block'=>true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $('#start-date').datetimepicker({
    sideBySide:true,
    useCurrent: 'day'
  });
  $('#start-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#start-date').datetimepicker('show');
    });
  $('#end-date').datetimepicker({
    sideBySide:true,
    useCurrent: 'day'
  });
  $('#end-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#end-date').datetimepicker('show');
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
