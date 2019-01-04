<?php $this->assign('title','Instrument Stats')?>
<h3>Status of Instrument Reviews</h3>

<?php
use Cake\Utility\Hash;
$regions = array_unique(Hash::extract($status, '{n}.region'),SORT_STRING);
$status_levels = array_unique(Hash::extract($status, '{n}.current_status'),SORT_STRING);
$results = Hash::combine($status,'{n}.current_status','{n}.count','{n}.region');

// Sort Status Levels
$order = ['Engineering','Camera','Will Not Review','Todo','Blocked','In Progress','Complete'];
uasort($status_levels, function($key1, $key2) use ($order) {
	return ((array_search($key1, $order) > array_search($key2, $order)) ? 1 : -1);
});

// Totals Array
$totals = array();

echo '<table class="table table-striped table-condensed">';
echo '<thead><tr><th>Region</th>';
foreach ($status_levels as $sta) {
  echo '<th>' . $sta . '</th>';
}
echo '</tr></thead>';

foreach ($regions as $reg) {
  echo '<tr><th>' . $reg . '</th>';
  foreach ($status_levels as $sta) {
    if (array_key_exists($sta,$results[$reg])) {
      $totals[$sta] = isset($totals[$sta]) ?  $totals[$sta]+$results[$reg][$sta] : $results[$reg][$sta];  //Save running totals
      echo '<td>';
      echo $this->Html->link($results[$reg][$sta],['controller'=>'instruments','action'=>'index',$reg,$sta]);
      echo '</td>';
    } else {
      echo '<td></td>';
    }
  }
  echo '</tr>';
}

echo '<tr><th></th>';
$cumtotal = $totals['Todo']+$totals['Blocked']+$totals['In Progress']+$totals['Complete'];
foreach ($status_levels as $sta) {
  if (in_array($sta,['Todo','Blocked','In Progress','Complete'])) {
    echo sprintf('<th>%d<br>%0.1f%%</th>',$totals[$sta],$totals[$sta]/$cumtotal*100);  
  } else {
    echo sprintf('<th>%d</th>',$totals[$sta]);
  }
}
echo '</tr>';

echo '</table>';

?>
<!--
<?php if($import_time): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>
-->
