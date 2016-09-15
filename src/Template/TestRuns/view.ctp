<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Test Runs'), ['controller'=>'test-runs', 'action' => 'index']) ?></li>
  <li class="active"><?= h($testRun->name) ?> (#<?= $this->Number->format($testRun->id) ?>)</li>
</ol>


<div class="btn-group pull-right" role="group" aria-label="...">
  <?php echo $this->Html->link('<span class="glyphicon glyphicon glyphicon-download-alt" aria-hidden="true"></span> CSV', ['action'=>'export', $testRun->id], ['class'=>'btn btn-default', 'escape'=>false]); ?>
  <?php 
    $session = $this->request->session();
    if ($session->read('Auth.User.id')==$testRun->user_id) {
      echo $this->Html->link('Edit Test Run', ['action'=>'edit', $testRun->id], ['class'=>'btn btn-info']);
    }
  ?>
</div>

<h3><?= h($testRun->name) ?> (#<?= $this->Number->format($testRun->id) ?>)</h3>

<div clas="row">
  <div class="col-md-6">

<dl class="dl-horizontal">
  <dt>Reference Designator</dt>
  <dd><?= $this->Html->link($testRun->reference_designator,['controller'=>'instruments','action'=>'view',$testRun->reference_designator, '#'=>'tests']) ?></dd>
  <dt>Deployment</dt>
  <dd><?= h($testRun->deployment) ?></dd>
  <dt>Date Range</dt>
  <dd><?php if ($testRun->start_date) { ?>
    <?= $this->Time->i18nFormat($testRun->start_date,'MMMM d, yyyy')  ?> to 
    <?= $this->Time->i18nFormat($testRun->end_date,'MMMM d, yyyy') ?>
    <?php } ?></dd>
  <dt>Revised</dt>
  <dd><?= $this->Time->timeAgoInWords($testRun->modified) ?></dd>
  <dt>Status</dt>
  <dd><?= h($testRun->status) ?></dd>
  <dt>Comment</dt>
  <dd><?= h($testRun->comment) ?></dd>
  <dt>Test Owner</dt>
  <dd><?= $testRun->has('user') ? $testRun->user->full_name : '' ?></dd>
</dl>

  </div>
  <div class="col-md-6">

    <h3>Test Statistics</h3>
    <?php
      if ($testRun->count_items) {
        $cg = $testRun->count_complete_good / $testRun->count_items * 100;
        $cb = $testRun->count_complete_bad / $testRun->count_items * 100;
        $rg = $testRun->count_reasonable_good / $testRun->count_items * 100;
        $rb = $testRun->count_reasonable_bad / $testRun->count_items * 100;
      } else {
        $cg = $cb = $rg = $rb = 0;
      }
    ?>
    <dl class="dl-horizontal">
      <dt>Complete</dt>
      <dd>
        <small><strong>Pass or N/A</strong>: <?= $testRun->count_complete_good ?>, <strong>Fail</strong>: <?= $testRun->count_complete_bad ?></small>
        <div class="progress">
          <div class="progress-bar progress-bar-success" style="width: <?= $this->Number->toPercentage($cg) ?>">
            <?= $this->Number->toPercentage($cg,0) ?>
          </div>
          <div class="progress-bar progress-bar-danger" style="width: <?= $this->Number->toPercentage($cb) ?>">
            <?= $this->Number->toPercentage($cb,0) ?>
          </div>
        </div>
      </dd>
      <dt>Reasonable</dt>
      <dd>
        <small><strong>Pass, N/A or N/R</strong>: <?= $testRun->count_reasonable_good ?>, <strong>Fail/Suspect/Software</strong>: <?= $testRun->count_reasonable_bad ?></small>
        <div class="progress">
          <div class="progress-bar progress-bar-success" style="width: <?= $this->Number->toPercentage($rg) ?>">
            <?= $this->Number->toPercentage($rg,0) ?>
          </div>
          <div class="progress-bar progress-bar-danger" style="width: <?= $this->Number->toPercentage($rb) ?>">
            <?= $this->Number->toPercentage($rb,0) ?>
          </div>
        </div>
      </dd>
      <dt>Number of Items</dt>
      <dd><?= $testRun->count_items ?></dd>
    </dl>
    
  </div>

<h3><?= __('Parameter Tests') ?></h3>
<?php if (count($testItems)>0): ?>
<table id="parameterTests" class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
        <th>Id</th>
        <th>Method</th>
        <th>Stream</th>
        <th>Parameter</th>
        <th>Complete</th>
        <th>Reasonable</th>
        <th></th>
        <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th>Id</th>
        <th>Method</th>
        <th>Stream</th>
        <th>Parameter</th>
        <th>Complete</th>
        <th>Reasonable</th>
        <th></th>
        <th></th>
    </tr>
  </tfoot>
  <tbody>
  <?php foreach ($testItems as $testItem): ?>
    <tr>
        <td><?= h($testItem->id) ?></td>
        <td><?= h($testItem->method) ?></td>
        <td><?= h($testItem->stream->name) ?></td>
        <td><?= ($testItem->parameter) ? h($testItem->parameter->name) . ' (PD' . h($testItem->parameter->id) . ')' : '' ?></td>
        <td><?= h($testItem->status_complete) ?></td>
        <td><?= h($testItem->status_reasonable) ?></td>
        <td>
          <?= $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true">',['controller'=>'test-items','action'=>'edit',$testItem->id],['escape'=>false])?></td>
        <td>
          <?= ($testItem->comment) ? '<a data-toggle="tooltip" data-placement="left" title="' . h($testItem->comment) . '"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>' : '' ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php echo $this->Html->script('https://cdn.datatables.net/v/bs/dt-1.10.12/b-1.2.2/se-1.2.0/datatables.min.js', ['block' => true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function() {
  var table = $('#parameterTests').DataTable( {
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: false,
    buttons: [
      'selectNone',
      {
        extend: 'selected',
        text: 'Edit Selected',
        action: function () {
          var itemCount = table.rows( { selected: true } ).count();
          $('#item-count').html(itemCount);
          var tableData = table.rows( { selected: true } ).data();
          idList=[];
          for(var idx=0; idx < tableData.length; idx++) {
            idList.push(tableData[idx][0]);
          }
          $('#test-ids').val(JSON.stringify(idList));
          $('#editTestItems').modal('show');
        },
      }
    ],
    columnDefs: [ { "targets": [ 0 ], "visible": false }],
    select: {style: 'multi'},
    initComplete: function () {
      this.api().columns().every( function () {
        var column = this;
        col_title = $(column.header()).html();
        if (col_title) {
          var select = $('<select><option value=""></option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              column
                .search( val ? '^'+val+'$' : '', true, false )
                .draw();
            } );

          column.data().unique().sort().each( function ( d, j ) {
            if(d) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
            }
          } );
        }
      } );
    }
  } );

  table.buttons().container()
    .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
  
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/b-1.2.2/se-1.2.0/datatables.min.css"/>
 
<?php else: ?>
<p>No test items.</p>
<?php endif; ?>




<div class="modal fade" tabindex="-1" role="dialog" id="editTestItems">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editing <span id='item-count'>0</span> Test Items</h4>
      </div>
      <div class="modal-body">

        <?= $this->Form->create('', [ 'url'=>['action'=>'update-test-items', $testRun->id] ]); ?>
        <fieldset>
            <?php
                echo '<input type="hidden" name="test-ids" id="test-ids">';
                $this->Form->unlockField('test-ids');
                echo $this->Form->input('status_complete',[
                  'label' => "The parameter's record is complete",
                  'options' => [
                    'Pass'=>'Pass',
                    'Fail'=>'Fail',
                    'N/A'=>'Not Available'
                  ],
                  'empty' => true]);
                echo $this->Form->input('status_reasonable',[
                  'label' => "The science parameter's values are reasonable",
                  'options' => [
                    'Pass'=>'Pass',
                    'Fail'=>'Fail',
                    'Suspect'=>'Suspect',
                    'Software'=>'Software Investigation',
                    'N/R'=>'Not for Review',
                    'N/A'=>'Not Available'
                  ],
                  'empty' => true]);
                echo $this->Form->input('comment');
                echo $this->Form->input('redmine_issue');
            ?>
        </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
