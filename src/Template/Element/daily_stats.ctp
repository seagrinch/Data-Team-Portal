<div id='chart_div'></div>
<div id='legend_div'></div>

<?php $this->Html->script('https://d3js.org/d3.v4.min.js',['block'=>true]); ?>
<?php $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.24.0/d3-legend.js',['block'=>true]); ?>
<?php $this->Html->script('https://d3js.org/d3-scale-chromatic.v1.min.js',['block'=>true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>

var width = 960,
    height = 136,
    cellSize = 17;

var formatPercent = d3.format(".0%");

//var color = d3.scaleLinear() //alternately use scaleQuantize()
//    .domain([0,.1,.2,.3,.4,.5,.6,.7,.8,.9,1])
    //.range(['#d7191c', '#f7fbff','#deebf7','#c6dbef','#9ecae1','#6baed6','#4292c6','#2171b5','#08519c','#08306b'])
    //.range(["#d7191c", "#ffffbf", "#2c7bb6"]);
    //.range(['#f7feae','#b7e6a5','#7ccba2','#46aea0','#089099','#00718b','#045275']); // From https://carto.com/carto-colors/
//    .range(['#AB653B','#A67232','#9C8030','#8E8E35','#7D9A44','#68A65B','#50B076','#33B895','#1BBFB5','#30C4D2','#5FC6EB']); //http://tristen.ca/hcl-picker/#/hlc/11/1.08/5EC6EB/AB653B

var color = d3.scaleSequential(d3.interpolateBlues)
      .domain([0,1]);

var svg = d3.select("#chart_div")
  .selectAll("svg")
  .data(d3.range(2013, 2019))
  .enter().append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr('class','year')
    .attr("transform", "translate(" + ((width - cellSize * 53) / 2) + "," + (height - cellSize * 7 - 1) + ")");

// Year Labels
svg.append("text")
    .attr("transform", "translate(-6," + cellSize * 3.5 + ")rotate(-90)")
    .attr("font-family", "sans-serif")
    .attr("font-size", 10)
    .attr("text-anchor", "middle")
    .text(function(d) { return d; });

// Daily boxex
var rect = svg.append("g")
    .attr("fill", "none")
    .attr("stroke", "#ccc")
  .selectAll("rect")
  .data(function(d) { return d3.timeDays(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
  .enter().append("rect")
    .attr("width", cellSize)
    .attr("height", cellSize)
    .attr("x", function(d) { return d3.timeWeek.count(d3.timeYear(d), d) * cellSize; })
    .attr("y", function(d) { return d.getDay() * cellSize; })
    .datum(d3.timeFormat("%Y-%m-%d"));

// Month outlines
svg.append("g")
    .attr("fill", "none")
    .attr("stroke", "#000")
  .selectAll("path")
  .data(function(d) { return d3.timeMonths(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
  .enter().append("path")
    .attr("d", pathMonth);

// Month labels
var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

svg.append('g')
  .selectAll('text')
  .data(function(d) { return d3.timeMonths(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
  .enter().append('text')
    .text(function (d,i) { return month[i]; })
    .attr("font-family", "sans-serif")
    .attr("font-size", 10)
    .attr('transform', function (d, i) { 
      return 'translate(' + (d3.timeWeek.count(d3.timeYear(d), d) +1)* cellSize + ',-5)'; 
    });

d3.json('<?=$data_url?>', function(error, json_data) {
  if (error) throw error;

  var data = d3.nest()
      .key(function(d) { return d.date; })
      .rollup(function(d) { return { 
        percentage: d[0].percentage,
        count: d[0].count,
        sum: d[0].sum }; })
    .object(json_data);

  rect.filter(function(d) { return d in data; })
      .attr("fill", function(d) { return color(data[d].percentage); })
      .attr("opacity",.5)
    .append("title")
      .text(function(d) { return d + ": " + formatPercent(data[d].percentage) + ' (' + data[d].sum + '/' + data[d].count + ')'; });

});

function pathMonth(t0) {
  var t1 = new Date(t0.getFullYear(), t0.getMonth() + 1, 0),
      d0 = t0.getDay(), w0 = d3.timeWeek.count(d3.timeYear(t0), t0),
      d1 = t1.getDay(), w1 = d3.timeWeek.count(d3.timeYear(t1), t1);
  return "M" + (w0 + 1) * cellSize + "," + d0 * cellSize
      + "H" + w0 * cellSize + "V" + 7 * cellSize
      + "H" + w1 * cellSize + "V" + (d1 + 1) * cellSize
      + "H" + (w1 + 1) * cellSize + "V" + 0
      + "H" + (w0 + 1) * cellSize + "Z";
}

// Legend

var svg2 = d3.select("#legend_div")
  .append('svg')
  .attr("width", width)
  .attr("height", 90);

svg2.append('g')
  .attr("class", "legendLinear")
  .attr("transform", "translate(20,20)");

var legendLinear = d3.legendColor()
  .shapeWidth(40)
  .orient('horizontal')
  .cells(11)
  .scale(color)
  .labelFormat(formatPercent);

svg2.select(".legendLinear")
  .call(legendLinear);

<?php $this->Html->scriptEnd(); ?>