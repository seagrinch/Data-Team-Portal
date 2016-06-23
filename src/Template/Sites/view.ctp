<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($site->region->name,['controller'=>'regions','action'=>'view',$site->region->reference_designator]) ?></li>
  <li class="active"><?= h($site->name) ?></li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->check('Auth.User')) { 
    echo $this->Html->link('Edit Site', ['action'=>'edit', $site->reference_designator], ['class'=>'btn btn-info pull-right']);
  }
?>

<h3><?= h($site->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($site->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $site->description ?></dd>
  <dt><?= __('Array Name') ?></dt>
  <dd><?= $site->array_name ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($site->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($site->longitude) ?></dd>
  <dt><?= __('Bottom Depth') ?></dt>
  <dd><?= $this->Number->format($site->bottom_depth) ?></dd>
  <dt><?= __('Current Status') ?></dt>
  <dd><?php if ($site->current_status=='deployed') { ?>
      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> Deployed
    <?php } elseif ($site->current_status=='recovered') { ?>
      <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red;"></span> Recovered
    <?php } else { ?>
      <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
    <?php } ?>
  </dd>
</dl>

<h3>Nodes & Instruments</h3>
<ul>
  <?php foreach ($site->nodes as $node): ?>
  <li><?= $this->html->link($node->name,['controller'=>'nodes','action'=>'view',$node->reference_designator]) ?> <small>(<?= h($node->reference_designator) ?>)</small>
    <ul>
      <?php foreach ($node->instruments as $instrument): ?>
      <li><?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small></li>
      <?php endforeach; ?>
    </ul>
  </li>
  <?php endforeach; ?>
</ul>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($site);
*/
?>