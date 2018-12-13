<?php $this->assign('title','Monthly stats for '.$instrument->reference_designator)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'array_monthly']) ?></li>
  <li><?= $this->html->link($instrument->node->site->region->name,['controller'=>'regions','action'=>'stats_monthly',$instrument->node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->site->name,['controller'=>'sites','action'=>'stats_monthly',$instrument->node->site->reference_designator]) ?></li>
  <li><?= $this->html->link($instrument->node->name,['controller'=>'nodes','action'=>'stats_monthly',$instrument->node->reference_designator]) ?></li>
  <li class="active"><?= $this->html->link($instrument->name,['action'=>'view',$instrument->reference_designator]) ?></li>
</ol>


<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'http://oceanobservatories.org/site/' . substr($instrument->reference_designator,0,8), 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
    <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'https://ooinet.oceanobservatories.org/plot/#' . $instrument->reference_designator, 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
  </div>
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'view', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-daily', $instrument->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-monthly', $instrument->reference_designator],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
  </div>
</div>


<h3><?= h($instrument->reference_designator) ?></h3>

<!-- Stats Graph -->
<?php echo $this->element('monthly_stats', [
  'data_url'=>$this->Url->build([
    'controller'=>'instruments',
    'action'=>'statsMonthly',
    $instrument->reference_designator,
    '_ext'=>'json']),
  'dtype'=>'Instrument'
  ]);
?>

<?php if(isset($import_time)): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>

<?php echo $this->element('stats_caveat_instrument'); ?>
