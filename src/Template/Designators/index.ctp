<h1>OOI Arrays</h1>
<ul>
  <?php foreach ($designators as $designator): ?>
  <li><?= $this->html->link($designator->name,['action'=>'view',$designator->reference_designator]) ?> (<?= h($designator->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>
