<?php $this->assign('title','Reference List')?>
<div class="row">
  <div class="col-md-6">
    
    <h3>Infrastructure Pages <a href="https://github.com/seagrinch/data-team-python"><small>[GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span>]</small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Arrays',['controller'=>'regions'])?></li>
      <li><?php echo $this->Html->link('Sites',['controller'=>'sites'])?></li>
      <li><?php echo $this->Html->link('Nodes',['controller'=>'nodes'])?></li>
      <li><?php echo $this->Html->link('Instruments',['controller'=>'instruments'])?> 
          [<?php echo $this->Html->link('DataTable',['controller'=>'instruments', 'action'=>'all'])?>]</li>
      <li><?php echo $this->Html->link('Instrument Classes',['controller'=>'instrument_classes'])?></li>
      <li><?php echo $this->Html->link('Instrument Models',['controller'=>'instrument_models'])?></li>
      <li><?php echo $this->Html->link('Data Streams',['controller'=>'data-streams'])?></li>
    </ul>
    
    <h3>Preload Information <a href="https://github.com/oceanobservatories/preload-database"><small>[GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span>]</small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Streams',['controller'=>'streams'])?> 
          [<?php echo $this->Html->link('DataTable',['controller'=>'streams', 'action'=>'all'])?>]</li>
      <li><?php echo $this->Html->link('Parameters',['controller'=>'parameters'])?> 
          [<?php echo $this->Html->link('DataTable',['controller'=>'parameters', 'action'=>'all'])?>]</li>
      <li><?php echo $this->Html->link('Parameter Functions',['controller'=>'parameter-functions'])?></li>
    </ul>
    
    <h3>Asset Information  <a href="https://github.com/ooi-integration/asset-management"><small>[GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span>]</small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Assets',['controller'=>'assets'])?>
          [<?php echo $this->Html->link('DataTable',['controller'=>'assets', 'action'=>'all'])?>]</li>
      <li>Calibrations - See Asset pages</li>
      <li><?php echo $this->Html->link('Cruises',['controller'=>'cruises'])?></li>
      <li>Deployments - See Instrument, Asset or Cruise pages</li>
    </ul>  

    <h3>Ingestion Information  <a href="https://github.com/ooi-integration/ingestion-csvs"><small>[GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span>]</small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Ingestions',['controller'=>'ingestions'])?></li>
    </ul>  
    
  </div>
  <div class="col-md-6">
  
    <h3>Data Team Reviews</h3>
    <ul>
      <li>Data Review Reports - See Instrument pages</li>
      <li><?php echo $this->Html->link('Review Notes',['controller'=>'Notes'])?> [<?php echo $this->Html->link('CSV Export',['controller'=>'Notes', 'action'=>'export'])?>]</li>
      <li><?php echo $this->Html->link('Cruise Reviews',['controller'=>'CruiseReviews'])?> (deprecated)</li>
      <li><?php echo $this->Html->link('Deployment Reviews',['controller'=>'DeploymentReviews'])?> (deprecated)</li>
      <li><?php echo $this->Html->link('Test Runs',['controller'=>'TestRuns'])?> (deprecated)</li>
    </ul>

    <h3>Annotations</h3>
    <p>Annotations are now pulled directly from uFrame, however they are loaded into this system once a day via script.  When uFrame supports filtering by reference designator, this could be done dynamically.</p>
    
    <h3>Miscellaneous Reports</h3>
    <ul>
      <li><?php echo $this->Html->link('Science Parameters',['controller'=>'data-streams','action'=>'science'])?> - Auto generated list of all science parameters expected in the system</li>
      <li><?php echo $this->Html->link('Data Streams',['controller'=>'data-streams','action'=>'export'])?> - Auto generated list of all data streams in the system</li>
      <li><?php echo $this->Html->link('Import Log',['controller'=>'ImportLog'])?></li>
      <li><?php echo $this->Html->link('Summary Chart of Instrument Status',['controller'=>'instruments','action'=>'status'])?></li>
      <li><?php echo $this->Html->link('Monthly Array Stats',['controller'=>'regions','action'=>'array-monthly'])?></li>
    </ul>
      
  </div>
</div>
