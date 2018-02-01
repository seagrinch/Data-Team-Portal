<h3>Export Data Streams</h3>
<p>Select a region to download a list of all Data Streams as a CSV file.</p>
<ul>
  <?php foreach ($regions as $region): ?>
  <li><?= $this->html->link($region->name,['action'=>'export',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>
