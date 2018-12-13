<?php $this->assign('title','Automated Data Quality Checks')?>
<h2>Automated Data Quality Checks</h2>

<dl class="dl-horizontal">
  <dt>Deployment Number</dt>
  <dd>Instrument deployment number defined in OOI's Asset Management system.</dd>
  
  <dt>Preferred Method</dt>
  <dd>The data delivery method selected for review. For uncabled instruments this is always recovered instrument (when available) because this will be the most complete dataset. If recovered instrument is not available, recovered host (from the Data Concentrator Logger) or telemetered is reviewed.</dd>
  
  <dt>Stream</dt>
  <dd>Data stream name for the preferred method containing science data for review.</dd>

  <dt>Deployment Days</dt>
  <dd>Number of days the instrument was deployed.</dd>
  
  <dt>File Days</dt>
  <dd>Number of days for which there is at least 1 timestamp available for the instrument.</dd>
  
  <dt>Start Gap</dt>
  <dd>Number of missing days at the start of a deployment: comparison of the deployment start date to the data start date.</dd>
  
  <dt>End Gap</dt>
  <dd>Number of missing days at the end of a deployment: comparison of the deployment end date to the data end date.</dd>
  
  <dt>Gaps Count</dt>
  <dd>Number of gaps within a data file (exclusive of missing data at the beginning and end of a deployment). Gap is defined as >1 day of missing data.</dd>
  
  <dt>Gap Days</dt>
  <dd>Number of days of missing data within a data file (exclusive of missing data at the beginning and end of a deployment). </dd>
  
  <dt>Timestamps</dt>
  <dd>Number of timestamps in a data file.</dd>
  
  <dt>Sampling Rate</dt>
  <dd>Sampling rates are calculated from the differences in timestamps. The most common sampling rate is that which occurs >50%.</dd>
  
  <dt>Pressure Comparison</dt>
  <dd>Instrument deployment depth defined in OOI's Asset Management system / average (for fixed instruments) or maximum (for mobile instruments) pressure calculated from data file after eliminating data outside of global ranges and outliers (3 standard deviations).</dd>
  
  <dt>Time Order</dt>
  <dd>Test that timestamps in the file are unique and in ascending order.</dd>
  
  <dt>Valid Data</dt>
  <dd>For each science variable, the binned percent of data that are not NaNs, fill values, outside global ranges, and outside 5 standard deviations. Bins: 99 = >99%, 95 = 95-99%, 75 = 75-95%, 50 = 50-75%, 25 = 25-50%, 0 = 0-25%. For example, {'99':4, '95':1} means 4 science variables have >99% valid data points, and 1 science variable has between 95-99% valid data points.</dd>
  
  <dt>Missing Data</dt>
  <dd>Test fails if data are available in another stream from a "non-preferred" delivery method, where the same data are not available in the preferred data stream. Summary provides the number of gaps and days of data that are missing in the preferred dataset that should be available.</dd>
  
  <dt>Data Comparison</dt>
  <dd>Compare data values with matching timestamps for science variables among all delivery methods.</dd>
  
  <dt>Missing Coordinates</dt>
  <dd>Check the coordinates in the data file against expected coordinates: obs, time, lat, lon, pressure (for instruments not located on a surface buoy)</dd>
  
  <dt>Review</dt>
  <dd>The status of the review: Todo = data need to be reviewed, Tested = automated tests are complete, Blocked = automated tests are complete and an issue is preventing completion of the review, In Progress = automated tests are complete and Human In the Loop review is in progress, Complete = automated tests and Human In The Loop reviews are complete.</dd>

</dl>