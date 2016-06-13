<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($node->site->region->name,['controller'=>'regions','action'=>'view',$node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($node->site->name,['controller'=>'sites','action'=>'view',$node->site->reference_designator]) ?></li>
  <li class="active"><?= h($node->name) ?></li>
</ol>

<h3><?= h($node->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($node->reference_designator) ?></dd>
  <dt><?= __('Region') ?></dt>
  <dd><?= h($node->region_rd) ?></dd>
  <dt><?= __('Site') ?></dt>
  <dd><?= h($node->site_rd) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $node->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($node->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($node->longitude) ?></dd>
  <dt><?= __('Depth') ?></dt>
  <dd><?= $this->Number->format($node->end_depth) ?></dd>
</dl>

<h3>Instruments</h3>
<ul>
  <?php foreach ($node->instruments as $instrument): ?>
  <li><?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small></li>
  <?php endforeach; ?>
</ul>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($site);
*/
?>