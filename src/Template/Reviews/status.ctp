<?php $this->assign('title','Review Stats')?>
<h3>Status of Instrument-Stream-Deployment Reviews</h3>

<?php
use Cake\Utility\Hash;
$regions = array_unique(Hash::extract($status, '{n}.region'),SORT_STRING);
$status_levels = array_unique(Hash::extract($status, '{n}.status'),SORT_STRING);
$results = Hash::combine($status,'{n}.status','{n}.count','{n}.region');

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
      echo '<td>';
      echo $this->Html->link($results[$reg][$sta],['controller'=>'reviews','action'=>'index',$reg,$sta]); //$results[$reg][$sta];
      echo '</td>';
    } else {
      echo '<td></td>';
    }
  }
  echo '</tr>';
}
echo '</table>';

?>
