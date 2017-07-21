<?php 

if (!isset($data->status)) {
  // Find QC variables
  $keys = array_keys(get_object_vars($data[0]));
  $badkeys=[];
  foreach ($keys as $k) {
    if (strpos($k,'_qc_executed') || strpos($k,'_qc_results')) {
      array_push($badkeys,$k);
    }
  }
  
  // Remove unnecessary variables from output array
  foreach ($data as &$d) {
    unset($d->pk); // Metadata variable
    foreach ($badkeys as $k) {
      unset($d->$k); // QC variables
    }
  }
  echo json_encode($data, JSON_PRETTY_PRINT);

} else {
  $error = $data->status;
  echo $error;
//   echo json_encode(compact('error'), JSON_PRETTY_PRINT);
  
}
