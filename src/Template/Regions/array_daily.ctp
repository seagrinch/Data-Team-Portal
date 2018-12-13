<?php $this->assign('title','OOI Daily Stats')?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li class="active">Daily Stats</li>
</ol>


<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Arrays <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'index'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-daily'],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-monthly'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
</div>

<h3>All Arrays</h3>

<!-- Stats Graph -->
<?php echo $this->element('daily_stats', [
  'data_url'=>$this->Url->build([
    'controller'=>'regions',
    'action'=>'arrayDaily',
    '_ext'=>'json'])
  ]);
?>

<?php if(isset($import_time)): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>

<?php echo $this->element('stats_caveat'); ?>
