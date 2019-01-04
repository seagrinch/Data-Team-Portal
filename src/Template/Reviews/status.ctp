<?php $this->assign('title','Review Stats')?>
<h3>Status of Instrument-Stream-Deployment Reviews</h3>

<?php
use Cake\Utility\Hash;
$regions = array_unique(Hash::extract($status, '{n}.region'),SORT_STRING);
$status_levels = array_unique(Hash::extract($status, '{n}.status'),SORT_STRING);
$results = Hash::combine($status,'{n}.status','{n}.count','{n}.region');

// Sort Status Levels
$order = ['Tested','Blocked','In Progress','Complete'];
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
      echo $this->Html->link($results[$reg][$sta],['controller'=>'reviews','action'=>'index',$reg,$sta]); //$results[$reg][$sta];
      echo '</td>';
    } else {
      echo '<td></td>';
    }
  }
  echo '</tr>';
}

echo '<tr><th></th>';
$cumtotal = array_sum($totals);
foreach ($status_levels as $sta) {
  echo sprintf('<th>%d<br>%0.1f%%</th>',$totals[$sta],$totals[$sta]/$cumtotal*100);
}
echo '</tr>';

echo '</table>';

?>
