<div class="row">
  <div class="col-md-6">
    <h1>OOI Arrays</h1>
    <ul>
      <?php foreach ($regions as $region): ?>
      <li><?= $this->html->link($region->name,['action'=>'view',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)</li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-md-6">
    <div id="mapid" style="height: 500px;"></div>
  </div>
</div>

<?php $this->Html->css('/leaflet/leaflet',['block'=>true]); ?>
<?php $this->Html->script('/leaflet/leaflet',['block'=>true]); ?>
<?php $this->Html->script('oms.min',['block'=>true])?>

<?php $this->Html->scriptStart(['block' => true]); ?>
  var mymap = L.map('mapid').setView([10, -100], 2);
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
  foreach ($regions as $region): 
    if ($region->latitude && $region->longitude):
?>
    var marker = new L.marker([<?= $region->latitude?>, <?= $region->longitude?>],{title:"<?= $region->name?>"});
    marker.desc = '<?= $this->html->link($region->name,['action'=>'view',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)';
    mymap.addLayer(marker);
    oms.addMarker(marker);
<?php 
    endif;
  endforeach; 
?>
<?php $this->Html->scriptEnd(); ?>