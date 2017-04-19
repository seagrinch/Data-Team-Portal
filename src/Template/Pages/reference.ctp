<div class="row">
  <div class="col-md-6">
    
    <h3>Infrastructure Pages <a href="https://github.com/seagrinch/data-team-python"><small>GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span></small></a></h3>
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
    
    <h3>Preload Information <a href="https://github.com/oceanobservatories/preload-database"><small>GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span></small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Streams',['controller'=>'streams'])?> 
          [<?php echo $this->Html->link('DataTable',['controller'=>'streams', 'action'=>'all'])?>]</li>
      <li><?php echo $this->Html->link('Parameters',['controller'=>'parameters'])?> 
          [<?php echo $this->Html->link('DataTable',['controller'=>'parameters', 'action'=>'all'])?>]</li>
      <li><?php echo $this->Html->link('Parameter Functions',['controller'=>'parameter-functions'])?></li>
    </ul>
    
    <h3>Asset Information  <a href="https://github.com/ooi-integration/asset-management"><small>GitHub <span class="glyphicon glyphicon-link" aria-hidden="true"></span></small></a></h3>
    <ul>
      <li><?php echo $this->Html->link('Assets',['controller'=>'assets'])?></li>
      <li>Calibrations - See Asset pages</li>
      <li><?php echo $this->Html->link('Cruises',['controller'=>'cruises'])?></li>
      <li>Deployments - See Instrument, Asset or Cruise pages</li>
    </ul>  
    
  </div>
  <div class="col-md-6">
  
    <h3>Data Team Reviews</h3>
    <ul>
      <li><?php echo $this->Html->link('Cruise Reviews',['controller'=>'CruiseReviews'])?></li>
      <li><?php echo $this->Html->link('Notes',['controller'=>'Notes'])?></li>
      <li><?php echo $this->Html->link('Test Runs',['controller'=>'TestRuns'])?> (deprecated)</li>
      <li>Monthly Status Reports (coming soon)</li>
      <li>Data Review Reports (coming soon)</li>
    </ul>
      
  </div>
</div>
