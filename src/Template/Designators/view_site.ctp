<h3><?= h($designator->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($designator->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $designator->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($designator->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($designator->longitude) ?></dd>
</dl>

<h3>Platforms</h3>
<ul>
  <?php foreach ($designator->child as $child): ?>
  <li><?= $this->html->link($child->name,['action'=>'view',$child->reference_designator]) ?> (<?= h($child->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>

