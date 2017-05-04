<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li class="active"><?= h($region->name) ?></li>
</ol>

<h3><?= h($region->name) ?></h3>

<div class="row">
  <div class="col-md-6">

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($region->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $region->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($region->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($region->longitude) ?></dd>
</dl>

<h3>Platforms</h3>
<ul>
  <?php foreach ($region->sites as $site): ?>
  <li><?= $this->html->link($site->name,['controller'=>'sites','action'=>'view',$site->reference_designator]) ?> (<?= h($site->reference_designator) ?>)</li>
  <?php endforeach; ?>
</ul>

  </div>
  <div class="col-md-6">
    <div id="mapid" style="height: 400px;"></div>
  </div>
</div>

<?php $this->Html->css('/leaflet/leaflet',['block'=>true]); ?>
<?php $this->Html->script('/leaflet/leaflet',['block'=>true]); ?>
<?php $this->Html->script('oms.min',['block'=>true])?>

<?php 
  if (($region->reference_designator=="CE") || ($region->reference_designator=="RS")) {
    $zoomlevel = 6;
  } elseif ($region->reference_designator=="CP") {
    $zoomlevel = 9;
  } else {
    $zoomlevel = 8;
  }  
?>
<?php $this->Html->scriptStart(['block' => true]); ?>
  var mymap = L.map('mapid').setView([<?=$region->latitude?>, <?=$region->longitude?>], <?= $zoomlevel?>);
  var highResMap = L.tileLayer.wms('https://maps.oceanobservatories.org/mapserv?map=/public/mgg/web/gmrt.marine-geo.org/htdocs/services/map/wms_merc.map&', {
    // maxZoom: 12,
    // minZoom: 2.6,
    attribution: 'Global Multi-Resolution Topography (GMRT), Version 3.2',
    layers: 'topo',
    format: 'image/png',
    transparent: true,
    // bounceAtZoomLimits: true,
    // crs: L.CRS.EPSG4326,
    crs: L.CRS.EPSG3857
  });
  highResMap.addTo(mymap);

  var oms = new OverlappingMarkerSpiderfier(mymap);
  var popup = new L.Popup();
  oms.addListener('click', function(marker) {
    popup.setContent(marker.desc);
    popup.setLatLng(marker.getLatLng());
    mymap.openPopup(popup);
  });
  oms.addListener('spiderfy', function(markers) {
    mymap.closePopup();
  });
  
<?php 
  foreach ($region->sites as $site): 
    if ($site->latitude && $site->longitude):
?>
    var marker = new L.marker([<?= $site->latitude?>, <?= $site->longitude?>],{title:"<?= $site->name?>"});
    marker.desc = '<?= $this->html->link($site->name,['controller'=>'sites','action'=>'view',$site->reference_designator]) ?> (<?= h($site->reference_designator) ?>)';
    mymap.addLayer(marker);
    oms.addMarker(marker);
<?php 
    endif;
  endforeach; 
?>
<?php $this->Html->scriptEnd(); ?>
