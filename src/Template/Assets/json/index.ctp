<?php 
/*
foreach ($articles as &$$article) {
    unset($article->generated_html);
}
*/
//$this->layout = 'ajax';

$data =[];

foreach ($assets as $asset) {
  $item = [
    'asset_uid' => $asset->asset_uid,
    'type' => $asset->type,
    'description_of_equipment' => $asset->description_of_equipment,
    'manufacturer' => $asset->manufacturer,
    'model' => $asset->model,
    'node_name' => $asset->name,
    'manufacturer_serial_no' => $asset->manufacturer_serial_no,
  ];
  array_push($data, $item);
}

echo json_encode(compact('data'), JSON_PRETTY_PRINT);
