<h3>Instrument Status</h3>

<?php
use Cake\Utility\Hash;
$regions = array_unique(Hash::extract($status, '{n}.region'));
$status_levels = array_unique(Hash::extract($status, '{n}.current_status'));
$results = Hash::combine($status,'{n}.current_status','{n}.count','{n}.region');

echo '<table class="table table-striped" cellpadding="0" cellspacing="0">';
echo '<thead><tr><th>Region</th>';
foreach ($status_levels as $sta) {
  echo '<th>' . $sta . '</th>';
}
echo '</tr></thead>';

foreach ($regions as $reg) {
  echo '<tr><th>' . $reg . '</th>';
  foreach ($status_levels as $sta) {
    echo '<td>' . (array_key_exists($sta,$results[$reg]) ? $results[$reg][$sta] : ''). '</td>';
  }
  echo '</tr>';
}
echo '</table>';
