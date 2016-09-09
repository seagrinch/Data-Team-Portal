<?php 
/*
foreach ($articles as &$$article) {
    unset($article->generated_html);
}
*/
//$this->layout = 'ajax';

$data =[];

foreach ($instruments as $instrument) {
  $item = [
    'reference_designator' => $instrument->reference_designator,
    'name' => $instrument->name,
    'start_depth' => $instrument->start_depth,
    'end_depth' => $instrument->end_depth,
    'node' => $instrument->node->reference_designator,
    'node_name' => $instrument->node->name,
    'site' => $instrument->node->site->reference_designator,
    'site_name' => $instrument->node->site->name,
    'region' => $instrument->node->site->region->reference_designator,
    'region_name' => $instrument->node->site->region->name,
  ];
  array_push($data, $item);
}

echo json_encode(compact('data'), JSON_PRETTY_PRINT);
