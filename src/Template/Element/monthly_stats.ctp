<div id='chart_div'></div>

<?php $this->Html->script('https://d3js.org/d3.v4.min.js',['block'=>true]); ?>
<?php $this->Html->script('d3-summary-tiles',['block'=>true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
// Adapted from https://github.com/madams1/d3-summary-tiles

d3.json('<?=$data_url?>', function(error, json_data) {
  if (error) throw error;

  openBox = function(e) {
    var rd = e.reference_designator;
    switch (rd.length) {
      case 2:
        window.open('/regions/stats-monthly/'+rd,'_self');
        break;
      case 8:
        window.open('/sites/stats-monthly/'+rd,'_self');
        break;
      case 27: // Add capitalization check to make sure it's a reference designator?
        window.open('/instruments/stats-monthly/'+rd,'_self');
        break;
    }

  };

  let summaryTiles = d3.summaryTiles();
  
  summaryTiles
      .data(json_data)
      .x("month")
      .rotateXTicks()
      .y("reference_designator")
      .yLabel('<?=$dtype?>')      
      .fill("percentage")
      .tileWidth(20)
      .tileHeight(20)
      .tooltipWidth(320)
      .numberFormat( d3.format(".0%") )
      .legendTitle('Daily Coverage')
      .colorScheme("Blues")
      .onClick(openBox)
      .horizontalPadding(<?php 
        if ( in_array($dtype, ['Site','Node']) ) {
          echo 220;
        } elseif ( in_array($dtype, ['Instrument']) ) {
            echo 250;
        } else {
            echo 100;
        } ?>);
  
  d3.select("#chart_div")
      .call(summaryTiles);

});
    
<?php $this->Html->scriptEnd(); ?>