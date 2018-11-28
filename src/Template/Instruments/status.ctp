<h3>Status of Instrument Reviews</h3>

<?php
use Cake\Utility\Hash;
$regions = array_unique(Hash::extract($status, '{n}.region'),SORT_STRING);
$status_levels = array_unique(Hash::extract($status, '{n}.current_status'),SORT_STRING);
$results = Hash::combine($status,'{n}.current_status','{n}.count','{n}.region');

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
      echo $this->Html->link($results[$reg][$sta],['controller'=>'instruments','action'=>'index',$reg,$sta]);
      echo '</td>';
    } else {
      echo '<td></td>';
    }
  }
  echo '</tr>';
}
echo '</table>';

?>
<!--
<?php if($import_time): ?>
<p>Last import: <?= $this->Time->timeAgoInWords($import_time->import_date) ?>
<?php endif; ?>
-->
