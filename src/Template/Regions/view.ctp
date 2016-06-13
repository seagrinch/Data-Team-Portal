<h3><?= h($region->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($region->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $region->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($region->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($region->longitude) ?></dd>
</dl>

<h3>Platforms</h3>
<ul>
  <?php foreach ($region->sites as $site): ?>
  <li><?= $this->html->link($site->name,['controller'=>'sites','action'=>'view',$site->reference_designator]) ?> (<?= h($site->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>
