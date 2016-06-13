<h1>OOI Arrays</h1>
<ul>
  <?php foreach ($regions as $region): ?>
  <li><?= $this->html->link($region->name,['action'=>'view',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>
