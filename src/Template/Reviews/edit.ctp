<ol class="breadcrumb">
  <li>Reviews</li>
  <li><?= $this->html->link($review->reference_designator,['controller'=>'instruments','action'=>'report',$review->reference_designator]) ?></li>
  <li class="active">Review # <?= h($review->id) ?></li>
</ol>


<legend>Edit Review</legend>
<div class="pull-right">
  <?= $this->Form->postLink(__('Delete Review'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete this review for {0}?', $review->reference_designator), 'class'=>'']) ?>
</div>
  
<?= $this->Form->create($review) ?>
<fieldset>
  <dl class="dl-horizontal">
    <dt>Reference Designator:</dt>
    <dd><?= h($review->reference_designator) ?></dd>
    <dt>Deployment:</dt>
    <dd><?= h($review->deployment) ?></dd>
    <dt>Preferred Method:</dt>
    <dd><?= h($review->preferred_method) ?></dd>
    <dt>Stream:</dt>
    <dd><?= h($review->stream) ?></dd>
    <dt>Reviewer:</dt>
    <dd><?= $review->has('user') ? h($review->user->full_name) : '' ?></dd>
  </dl>

  <div class="row">
    <div class='col-md-5'>
      <?php
        echo $this->Form->input('status',['label'=>'Status',
          'options'=>[
            'Tested'=>'Tested',
            'In Progress'=>'In Progress',
            'Blocked'=>'Blocked',
            'Complete'=>'Complete',
          ],'empty'=>true]);
        echo $this->Form->input('completed_date',[
          'type'=>'text',
          'append' => '<span class="glyphicon glyphicon-th" id="completed-date-dp"></span>',
          'value'=> $this->Time->i18nFormat($review->completed_date,'M/d/yyyy'),
        ]);
      ?>
    </div>
    <div class='col-md-7'>
      <?php
      echo $this->Form->input('notes',['type'=>'textarea', 'rows'=>12]);
      ?>

      <div class="pull-right">
        <?= $this->Html->link('Cancel', ['controller'=>'instruments', 'action' => 'report', $review->reference_designator], ['class'=>'btn btn-default']); ?> 
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

  $('#completed-date').datepicker({
    autoclose: true,
    todayHighlight: true,
    showOnFocus: false,
    format:  "m/d/yyyy"
  });
  $('#completed-date-dp')
    .css('cursor', 'pointer')
    .on('click', function () {
      $('#completed-date').datepicker('show');
    });
<?php $this->Html->scriptEnd(); ?>