<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li class="active">Monthly Stats</li>
</ol>


<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Arrays <span class="glyphicon glyphicon-info-sign" aria-hidden="true">', 
      ['action' => 'index'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-daily'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-monthly'],
      ['class'=>'btn btn-primary active','escape'=>false]) ?>
  </div>
</div>

<h3>All Arrays</h3>

<!-- Stats Graph -->
<?php echo $this->element('monthly_stats', [
  'data_url'=>$this->Url->build([
    'controller'=>'regions',
    'action'=>'arrayMonthly',
    '_ext'=>'json']),
  'dtype'=>'Array'
  ]);
?>
