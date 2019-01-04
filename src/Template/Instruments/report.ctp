<?php $this->assign('title',$instrument->reference_designator)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'view',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'view',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'view',$instrument->node->reference_designator]) ?></li>
  <li class="active"><?= h($instrument->name) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php 
      $session = $this->request->session();
      if ($session->check('Auth.User')) { 
        echo $this->Html->link('Edit Instrument', ['action'=>'edit', $instrument->reference_designator], ['class'=>'btn btn-info']);
      }
    ?>
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>', 
      ['action' => 'view', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
</div>

<h2><?= h($instrument->name) ?></h2>

<div class="row">
  <div class="col-md-5">

    <dl class="dl-horizontal">
      <dt><?= __('Reference Designator') ?></dt>
      <dd><?= h($instrument->reference_designator) ?></dd>
<!--
      <dt><?= __('Start Depth') ?></dt>
      <dd><?= $this->Number->format($instrument->start_depth) ?></dd>
      <dt><?= __('End Depth') ?></dt>
      <dd><?= $this->Number->format($instrument->end_depth) ?></dd>
      <dt><?= __('Location') ?></dt>
      <dd><?= h($instrument->location) ?></dd>
-->
      <dt><?= __('Review Status') ?></dt>
      <dd><?php echo $this->element('instrument_status', ['status'=>$instrument->current_status]); ?></dd>
      <dt><?= __('Note') ?></dt>
      <dd><?= h($instrument->note); ?></dd>
    </dl>

  </div>
  <div class="col-md-7">

    <dl class="dl-horizontal">
<!--
      <dt><?= __('Class') ?></dt>
      <dd><?= $this->Html->link($instrument_class->class, ['controller'=>'instrument_classes', 'action'=>'view', $instrument_class->class]) ?> (<?= h($instrument_class->name) ?>)</dd>
-->
      <dt><?= __('Series') ?></dt>
      <dd><?= $this->html->link($instrument_model->class . '-' .$instrument_model->series, ['controller'=>'instrument_models', 'action'=>'view', $instrument_model->class, $instrument_model->series]) ?></dd>
<!--
      <dt><?= __('Science Discipline') ?></dt>
      <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>
-->
      <dt>Make / Model</dt>
      <dd><?= h($instrument_model->make) ?> / <?= h($instrument_model->model) ?></dd>
    </dl>

  </div>
</div>


<?php if (count($instrument->reviews)>0): ?>
  <h3>Dataset Reviews
    <span class="small text-info">Last processed: <?php echo $this->Time->i18nFormat($instrument->reviews[0]['file_downloaded'])?></span>
  </h3>
  <div class="pull-right" style="margin-top:-2em"><?php echo $this->Html->link('<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> QC Check Info', 
    '/pages/quality-checks',['escape'=>false,'class'=>'text-muted']) ?></div>
  <table class="table table-striped table-condensed table-hover">
    <tr>
      <th><span data-toggle="popover" title="Deployment Number" data-content="instrument deployment number">Dep.</span></th>
      <th><span data-toggle="popover" title="Preferred Method" data-content="data delivery method selected for review">Preferred Method</span></th>
      <th><span data-toggle="popover" title="Stream" data-content="data stream name">Stream</span></th>
      <th class="text-right"><span data-toggle="popover" title="Deployment Days" data-content="# days in a deployment">DD</span></th>
      <th class="text-right"><span data-toggle="popover" title="File Days" data-content="# days of data available in file">FD</span></th>
      <th class="text-right"><span data-toggle="popover" title="Start Gap" data-content="# days missing at the start of a deployment">SG</span></th>
      <th class="text-right"><span data-toggle="popover" title="End Gap" data-content="# days missing at the end of a deployment">EG</span></th>
      <th class="text-right"><span data-toggle="popover" title="Gaps Count" data-content="# gaps in a data file">Gaps</span></th>
      <th class="text-right"><span data-toggle="popover" title="Gap Days" data-content="# days of missing data in a data file">GD</span></th>
      <th class="text-center"><span data-toggle="popover" title="Timestamps" data-content="# timestamps in a data file">TS</span></th>
      <th class="text-center"><span data-toggle="popover" title="Sampling Rate" data-content="common sampling rate (unit: seconds) in a data file">Rate (s)</span></th>
      <th class="text-center"><span data-toggle="popover" title="Pressure Comparison" data-content="deployment depth / average or maximum pressure">Pressure Comp.</span></th>
      <th class="text-center"><span data-toggle="popover" title="Time Order" data-content="check that timestamps are unique and in ascending order">Time Order</span></th>
      <th class="text-center"><span data-toggle="popover" title="Valid Data" data-content="% data that are not NaNs, fill values, outside global ranges, and outliers (5 SD)">Valid Data</span></th>
      <th class="text-center"><span data-toggle="popover" title="Missing Data" data-content="check for data available in a non-preferred data stream">Missing Data</span></th>
      <th class="text-center"><span data-toggle="popover" title="Data Comparison" data-content="compare data among all delivery methods">Data Comp.</span></th>
      <th class="text-center"><span data-toggle="popover" title="Missing Coordinates" data-content="check available coordinates against expected coordinates">Missing Coords.</span></th>
      <th>Review</th>
    </tr>
    <?php foreach ($instrument->reviews as $d): ?>
    <tr>
      <td><?= h($d->deployment) ?></td>
      <td><?= h($d->preferred_method) ?></td>
      <td><?php
        if (strlen($d->stream)>20) {
          echo $this->Text->insert('<span aria-hidden="true" data-toggle="tooltip" title=":title">:title2</span>',['title'=>$d->stream, 'title2'=>$this->Text->truncate($d->stream,20)],['escape'=>True]);          
        } else {
          echo $this->Text->insert(':title',['title'=>$d->stream]);
        } ?>
        </td>
      <td class="text-right"><?= h($d->n_days_deployed) ?></td>
      <td class="text-right"><?= h($d->n_days) ?></td>
      <td class="text-right"><?= h($d->start_days_missing) ?></td>
      <td class="text-right"><?= h($d->end_days_missing) ?></td>
      <td class="text-right"><?= h($d->gaps_num) ?></td>
      <td class="text-right"><?= h($d->gaps_num_days) ?></td>
      <td class="text-right"><?= (($d->n_timestamps) ? $this->Number->precision($d->n_timestamps,0) : '') ?></td>
      <td class="text-right">
        <?php 
          if ($d->sampling_rate_seconds) {
            if (is_numeric($d->sampling_rate_seconds)) {
              echo $this->Number->precision($d->sampling_rate_seconds,0);
            } else {
              echo $this->Text->insert('<span class="glyphicon glyphicon-exclamation-sign" style="color:gray;" aria-hidden="true" data-toggle="tooltip" title=":title"></span>',['title'=>$d->sampling_rate_seconds],['escape'=>True]);
            } 
          } ?>
      </td>
      <td class="text-right"><?= h($d->deploy_depth) ?> / <?= h($d->pressure_compare) ?> <!-- / <?= h($d->pressure_diff) ?> --></td>
      <td class="text-center"><?= $this->Footnote->check($d->timestamp_test) ?></td>
      <td class="text-center"><?php
        if ($d->valid_data_test) {
          $vd = json_decode(str_replace("'", '"', $d->valid_data_test),true);
          if (count($vd)==1 & array_key_exists('99',$vd)) {
              echo $this->Text->insert('<span class="glyphicon glyphicon-ok-sign" style="color:green;" aria-hidden="true" data-toggle="tooltip" title=":title"></span>',['title'=>$d->valid_data_test],['escape'=>True]);
          } else {
              echo $this->Text->insert('<span class="glyphicon glyphicon-exclamation-sign" style="color:gray;" aria-hidden="true" data-toggle="tooltip" title=":title"></span>',['title'=>$d->valid_data_test],['escape'=>True]);
          }
        }
        ?></td>
      <td class="text-center"><?= $this->Footnote->check($d->full_dataset_test) ?></td>
      <td class="text-center"><?= $this->Footnote->check($d->variable_comparison_test) ?></td>
      <td class="text-center"><?= $this->Footnote->check($d->coordinate_test) ?></td>
      <td><?php 
                if ($d->status) {
                  $txt = h($d->status);
                } else {
                  $txt = 'Todo';
                }
              echo $this->Html->link($txt,
                ['controller'=>'reviews', 'action'=>'edit', $d->id], 
                ['class'=>'']);
            ?></td>
    </tr>
    <?php endforeach; ?>
  </table>


<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
  <?= $this->Html->link('Final Stats','https://github.com/data-edu-ooi/data-review-tools/tree/master/data_review/final_stats/' . 
    $instrument->node->site->region->reference_designator . '/' . 
    $instrument->node->site->reference_designator . '/' . 
    $instrument->reference_designator . '_final_stats.csv', ['class'=>'btn btn-sm btn-primary']);?>

  <?= $this->Html->link('Review Images','https://marine.rutgers.edu/cool/ooi/data-eval/data_review/' . 
    $instrument->node->site->region->reference_designator . '/' . 
    $instrument->node->site->reference_designator . '/' . 
    $instrument->reference_designator, ['class'=>'btn btn-sm btn-warning']);?>
  </div>
</div>

  <h4>Test Notes</h4>
  <?php
    echo $this->Footnote->footnote_list();
  ?>

<?php else: ?>
  <h3>Dataset Reviews</h3>
  <p>No reviews found.</p>
<?php endif; ?>



<div class="row">
  <div class="col-md-6">

<!-- Data Coverage -->
<?php 
  $coverage = [];
  $deployments = [];
  if (count($instrument->reviews)>0) {
    foreach ($instrument->reviews as $d) {
      $deployments[] = $d->deployment;
      if ($d->n_days) {
        $coverage[$d->stream][$d->deployment] = $d->n_days / $d->n_days_deployed * 100;
      }
    }
    $deployments = array_unique($deployments);
    ksort($coverage);
  }?>
<?php if (count($coverage) > 0): ?>
<h3>Data Coverage</h3>
<table class="table table-condensed" style="width:auto;">
  <thead>
    <tr>
      <th>Deployment:</th>
      <th><?php echo implode('</th><th>', $deployments); ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($coverage as $key=>$row): ?>
    <tr>
      <td><?php 
        if (strlen($key)>20) {
          echo $this->Text->insert('<span aria-hidden="true" data-toggle="tooltip" title=":title">:title2</span>',['title'=>$key, 'title2'=>$this->Text->truncate($key,20)],['escape'=>True]);          
        } else {
          echo $this->Text->insert(':title',['title'=>$key]);
        } ?>
      </td>
      <?php foreach ($deployments as $d): 
        if (isset($row[$d])) {
          $c = ($row[$d] < 50 ? 'danger' : '');
          echo $this->Text->insert('<td class=":class">:percentage</td>', ['class'=>$c,'percentage'=>sprintf('%.0f%%',$row[$d])]);
        } else {
          echo '<td></td>';
        }
        endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

  </div>
  <div class="col-md-6">

<!-- Lat/Lon Differences -->
<?php 
  $kmdiff = [];
  $deployments = [];
  if (count($instrument->reviews)>0) {
    foreach ($instrument->reviews as $d) {
      $deployments[] = $d->deployment;
      if ($d->location_diff_km) {
        $kmdiff[$d->deployment] = json_decode($d->location_diff_km);
        $kmdiff[$d->deployment][$d->deployment]=0;        
      }
    }
    $deployments = array_unique($deployments);
    ksort($kmdiff);
  }?>
<?php if (count($kmdiff) > 0): ?>
<h3>Lat/Lon Differences (km)</h3>
<table class="table table-condensed" style="width:auto;">
  <thead>
    <tr>
      <th>Deployment:</th>
      <th><?php echo implode('</th><th>', $deployments); ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($kmdiff as $key=>$row): ?>
    <tr>
      <td><?php echo $key; ?></td>
      <?php foreach ($row as $r):
          $c = ($r > 5 ? 'danger' : '');
          echo $this->Text->insert('<td class=":class">:km</td>', ['class'=>$c,'km'=>sprintf('%.2f',$r)]);
        endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

  </div>
</div>

<h3>System Annotations <small><a class="" role="button" data-toggle="collapse" href="#collapseAnnotations" aria-expanded="false" aria-controls="collapseAnnotations">Show</a></small></h3>

<div class="collapse" id="collapseAnnotations">
  <?php echo $this->element('annotations_table', ['annotations'=>$instrument->annotations]); ?>
</div>


<h3>Review Notes</h3>
<?php echo $this->element('notes_table', ['notes'=>$instrument->notes]); ?>
<p class="text-left">
  <?php echo $this->Html->link(__('New Note'), ['controller'=>'notes','action'=>'add',$instrument->reference_designator], ['class'=>'btn btn-primary']); ?>
</p>


<?php $this->Html->scriptStart(['block' => true]); ?>  
  // Initialize Tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // Initialize Popovers
  $(function () {
    $('[data-toggle="popover"]').popover({'trigger':'click hover','placement':'bottom'})
  })

  // Javascript to enable link to tab
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href="#'+url.split('#')[1]+'"]').tab('show') ;
  } 
  
  // With HTML5 history API, we can easily prevent scrolling!
  $('.nav-tabs a').on('shown.bs.tab', function (e) {
      if(history.pushState) {
          history.pushState(null, null, e.target.hash); 
      } else {
          window.location.hash = e.target.hash; //Polyfill for old browsers
      }
  })
<?php $this->Html->scriptEnd(); ?>
