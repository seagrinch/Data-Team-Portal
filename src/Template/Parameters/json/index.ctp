<?php 
/*
foreach ($articles as &$$article) {
    unset($article->generated_html);
}
*/
//$this->layout = 'ajax';

$data =[];

foreach ($parameters as $parameter) {
  $item = [
    'id' => $parameter->id,
    'name' => $parameter->name,
    'display_name' => $parameter->display_name,
    'standard_name' => $parameter->standard_name,
    'unit' => $parameter->unit,
    'data_product_identifier' => $parameter->data_product_identifier,
    'data_product_type' => $parameter->data_product_type,
    'data_level' => $parameter->data_level,
  ];
  array_push($data, $item);
}

echo json_encode(compact('data'), JSON_PRETTY_PRINT);
