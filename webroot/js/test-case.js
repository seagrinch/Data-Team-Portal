$('#region').on('change',function(){
  var region = $('#region').val();
  var select = $('#site');
  if (region) {
    
    var sites_url = '/sites/index/' + region + '.json';
    $.get(sites_url, function(data) {
      select.empty().prepend('<option value="">(Choose a Site)</option>');
      for (var j = 0; j < data.length; j++){                 
        select.append($('<option></option>').val(data[j].reference_designator).html(data[j].reference_designator));
      } 
    });
  } else {
    select.empty().prepend('<option value="">-- Select an Array first --</option>');
  }
  $('#instrument').empty().prepend('<option value="">-- Select a Site first --</option>');
  $('#stream').empty().prepend('<option value="">--</option>');
});

$('#site').on('change',function(){
  var site = $('#site').val();
  var select = $('#instrument');
  if (site) {    
    var instruments_url = '/instruments/index/' + site + '.json';
    $.get(instruments_url, function(data) {
      select.empty().prepend('<option value="all">All Instruments</option>');
      for (var j = 0; j < data.length; j++){                 
        select.append($('<option></option>').val(data[j].reference_designator).html(data[j].reference_designator));
      } 
    });
  } else {
    select.empty().prepend('<option value="">-- Select a Site first --</option>');
  }
  $('#stream').empty().prepend('<option value="all">-- All Methods/Streams or Select an Instrument --</option>');
});

$('#instrument').on('change',function(){
  var instrument = $('#instrument').val();
  //$('#reference-designator').html(instrument);
  var select = $('#stream');
  if ((instrument) && (instrument!='all')) {    
    var instrument_url = '/instruments/view/' + instrument + '.json';
    $.get(instrument_url, function(data) {
      select.empty().prepend('<option value="all">All Methods/Streams</option>');
      var data_streams = data.instrument.data_streams
      for (var j = 0; j < data_streams.length; j++){                 
        select.append($('<option></option>')
          .val(data_streams[j].id)
          .html(data_streams[j].method + ' / ' + data_streams[j].stream_name));
      } 
    });
  } else {
    select.empty().prepend('<option value="all">-- All Methods/Streams or Select an Instrument --</option>');
  }
});

