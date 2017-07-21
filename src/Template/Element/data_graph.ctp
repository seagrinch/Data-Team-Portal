<div id='chart_div'></div>

<style>
#chart_div .axis path, #chart_div .axis line {
  fill: none;
  stroke: grey;
  stroke-width: 1px;
  shape-rendering: crispEdges;
  display: inherit;
}
.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}
</style>

<?php $this->Html->scriptStart(['block' => true]); ?>
d3.json('<?=$data_url?>', function(error, data) {
  if (error) throw error;
  
  if (data.message) {
    d3.select("#chart_div").append("p").text(data.message);
    throw (data.message)
  }

  var cols = d3.keys(data[0]);
  cols.pop('time');

  data.forEach(function(d) {
    d.date = new Date(d.time * 1000);
    d.data = +d[cols[0]];
  });

  d3.select("#chart_div").append("svg")
    .attr('id','data_chart')
    .attr("width", 800)
    .attr("height", 200);
    
  var svg = d3.select("#data_chart"),
      margin = {top: 20, right: 20, bottom: 30, left: 80},
      width = +svg.attr("width") - margin.left - margin.right,
      height = +svg.attr("height") - margin.top - margin.bottom,
      g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    
  var x = d3.time.scale.utc()
      .rangeRound([0, width]);
  
  var y = d3.scale.linear()
      .rangeRound([height, 0]);
  
  var xAxis = d3.svg.axis()
      .scale(x)
      .orient("bottom");
  var yAxis = d3.svg.axis()
      .scale(y)
      .orient("left");
  
  var line = d3.svg.line()
      .x(function(d) { return x(d.date); })
      .y(function(d) { return y(d.data); });
    
  x.domain(d3.extent(data, function(d) { return d.date; }));
  y.domain(d3.extent(data, function(d) { return d.data; }));

  g.append("g")
      .attr("transform", "translate(0," + height + ")")
      .attr("class","x axis")
      .call(xAxis)

  g.append("g")
      .attr("class","y axis")
      .call(yAxis)

  g.append("path")
      .datum(data)
      .attr("class", "line")
      .attr("d", line);

  g.append("text")
    .attr("class", "label")
    .attr("dy", "-4em")
    .attr("transform", "translate(" + (0) + "," + (height/2) + "), rotate(-90)")
    .attr("text-anchor", "middle")
    .style("font-size", "12px")    
    .style("font-weight", "normal")
    .style("fill", "grey")
    .text(cols[0]);

});

<?php $this->Html->scriptEnd(); ?>
