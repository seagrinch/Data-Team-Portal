<?php 
/*
foreach ($articles as &$$article) {
    unset($article->generated_html);
}
*/
//$this->layout = 'ajax';

$data =[];

foreach ($streams as $stream) {
  $item = [
    'id' => $stream->id,
    'name' => $stream->name,
    'stream_content' => $stream->stream_content,
    'stream_type' => $stream->stream_type,
  ];
  array_push($data, $item);
}

echo json_encode(compact('data'), JSON_PRETTY_PRINT);
