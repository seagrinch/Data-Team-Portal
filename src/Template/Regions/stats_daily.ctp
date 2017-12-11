<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li class="active"><?= $this->Html->link($region->name,['action' => 'view', $region->reference_designator]) ?></li>
</ol>


<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Info <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'view', $region->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-daily', $region->reference_designator],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'stats-monthly', $region->reference_designator],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
</div>


<h3><?= h($region->name) ?></h3>


<!-- Stats Graph -->
<?php echo $this->element('daily_stats', 
  ['data_url'=>$this->Url->build([
    'controller'=>'regions',
    'action'=>'statsDaily',
    $region->reference_designator,
    '_ext'=>'json'])
  ]);
?>

<?php if(isset($import_time)): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>

<?php echo $this->element('stats_caveat'); ?>
