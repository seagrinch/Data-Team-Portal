<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php echo $this->Html->link('Daily Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-daily'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
    <?php echo $this->Html->link('Monthly Stats <span class="glyphicon glyphicon-stats" aria-hidden="true">', 
      ['action' => 'array-monthly'],
      ['class'=>'btn btn-default','escape'=>false]) ?>
  </div>
</div>

<h1>OOI Arrays</h1>
<div class="row">
  <div class="col-md-6">
<!--     <?php echo $this->Html->link('Semi Real-time Status',['controller'=>'instruments','action'=>'status'],['class'=>'btn btn-info pull-right'])?> -->
    <ul>
      <?php foreach ($regions as $region): ?>
      <li><?= $this->html->link($region->name,['action'=>'view',$region->reference_designator]) ?> (<?= h($region->reference_designator) ?>)</li>
      <?php endforeach; ?>
    </ul>
    <p>&nbsp;</p>

    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">About this Site</h3>
      </div>
      <div class="panel-body">
        <p>This portal supports the OOI Data Team's efforts to review and annotate the official datasets provided by the OOI.  However, information provided on this site is not official and should be considered advisory only.  In addition, due to the fluid nature of the review process, this site may not be in sync with the information provided by the official <a href="https://ooinet.oceanobservatories.org">OOI Data Portal</a>.</p>
        <p>If you have any questions, please contact the <a href="http://oceanobservatories.org/helpdesk/">OOI Data Team</a>.</p>
      </div>
    </div>

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