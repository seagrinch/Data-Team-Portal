<?php $this->Html->css('https://fonts.googleapis.com/css?family=Muli',['block'=>true]); ?>
<?php $this->Html->css('/visavail/css/visavail.css',['block'=>true]); ?>
<?php $this->Html->css('/font-awesome/css/font-awesome.min.css',['block'=>true]); ?>
<?php $this->Html->script('/moment/moment-with-locales.min.js',['block'=>true]); ?>
<?php $this->Html->script('/d3/d3.min.js',['block'=>true]); ?>
<?php $this->Html->script('/visavail/js/visavail.js',['block'=>true]); ?>
<?php 
  $data=[];
  if (isset($deployments) && (count($deployments)>0)) {
    $data_deployments = [
      'measure'=>'Deployments',
      'categories'=>[
        'Deployed'=>['color'=>'#00be70']
      ]
    ];
    foreach ($deployments as $d) {
      $data_deployments['data'][] = [
        $this->Time->i18nFormat($d->start_date,'yyyy-MM-dd HH:mm:ss'), 
        'Deployed', 
        ($d->stop_date) ? $this->Time->i18nFormat($d->stop_date,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
    }
    array_push($data,$data_deployments);
  }
  if (isset($cassandra) && (count($cassandra)>0)) {
    $data_cassandra = [
      'measure'=>'Cassandra',
      'categories'=>[
        'Available'=>['color'=>'#295ea4']
      ]
    ];
    foreach ($cassandra as $c) {
      $data_cassandra['data'][] = [
        date('Y-m-d H:i:s', strtotime($c->beginTime)), 
        'Available', 
        ($c->endTime) ? date('Y-m-d H:i:s', strtotime($c->endTime)) : date("Y-m-d H:i:s")];
    }
    if(isset($data_cassandra['data'])) {
      array_push($data,$data_cassandra);    
    }
  }
  if (isset($annotations) && ($annotations->count()>0)) {
    $data_annotations = [
      'measure'=>'Annotations',
      'categories'=>[
        'available'=>['color'=>'green'],
        'fail'=>['color'=>'red'],
        'not_available'=>['color'=>'gray'],
        'not_evaluated'=>['color'=>'steelblue'],
        'not_operational'=>['color'=>'red'],
        'pending_ingest'=>['color'=>'lightgray'],
        'suspect'=>['color'=>'orange'],
        'Unknown'=>['color'=>'lightgrey'],
      ]
    ];
    foreach ($annotations as $a) {
      if ($a->start_datetime) {
        $data_annotations['data'][] = [
          $this->Time->i18nFormat($a->start_datetime,'yyyy-MM-dd HH:mm:ss'), 
          ($a->qcFlag) ? $a->qcFlag : 'Unknown', 
          ($a->end_datetime) ? $this->Time->i18nFormat($a->end_datetime,'yyyy-MM-dd HH:mm:ss') : date("Y-m-d H:i:s")];
      }
    }
    if(isset($data_annotations['data'])) {
      array_push($data,$data_annotations);    
    }
  }
?>
<?php if(count($data)>0):
  $this->Html->scriptStart(['block' => true]); ?>
  var dataset = <?php echo json_encode($data);?>;
  moment.locale("en");
  var chart = visavailChart().width(800); // define width of chart in px
  d3.select("#availability-chart")
    .datum(dataset)
    .call(chart);
<?php $this->Html->scriptEnd(); ?>
<div id="availability-chart" class="well"><!-- Visavail.js chart will be inserted here --></div>
<?php endif; ?>
