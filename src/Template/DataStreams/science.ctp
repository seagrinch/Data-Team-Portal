<h3>Data Stream Science Parameters</h3>
<p>Select a region to download all Data Stream Science Parameters as a CSV file.</p>
<ul>
  <?php foreach ($regions as $region): ?>
  <li><?= $this->html->link($region->name,['action'=>'science',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>

<?php 
/*
foreach ($dataStreams as $ds):
  echo $ds['reference_designator'] . ',' . 
    $ds['reference_designator'] . ',' . 
    $ds['_matchingData']['Streams']['name'] . '<br>';

endforeach;
*/
?>