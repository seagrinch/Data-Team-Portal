<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'array_monthly']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'stats_monthly',$site->region->reference_designator]) ?></li>
  <li class="active"><?= $this->Html->link($site->name,['action' => 'view', $site->reference_designator]) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('OOI Site Page <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'http://oceanobservatories.org/site/' . substr($site->reference_designator,0,8), 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
    <?php echo $this->Html->link('Data Portal <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>', 
      'https://ooinet.oceanobservatories.org/plot/#' . $site->reference_designator, 
      ['class'=>'btn btn-default', 'escape'=>false]); ?>
  </div>
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'view', $site->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-daily', $site->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-monthly', $site->reference_designator],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
  </div>
</div>

<h3><?= h($site->name) ?></h3>

<!-- Stats Graph -->
<?php echo $this->element('monthly_stats', [
  'data_url'=>$this->Url->build([
    'controller'=>'sites',
    'action'=>'statsMonthly',
    $site->reference_designator,
    '_ext'=>'json']),
  'dtype'=>'Site'
  ]);
?>

<?php if(isset($import_time)): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>

<?php echo $this->element('stats_caveat'); ?>
