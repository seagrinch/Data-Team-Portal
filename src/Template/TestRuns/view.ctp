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

<?php echo $this->Html->script('https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js', ['block' => true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function() {
  $('#parameterTests').DataTable( {
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: true,
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
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>


<?php else: ?>
<p>No test items.</p>
<?php endif; ?>

