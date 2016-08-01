$('#region').on('change',function(){
  var region = $('#region').val();
  var sites_url = '/sites/index/' + region + '.json';
  $.get(sites_url, function(data) {
    var select = $('#site');
    select.empty().prepend('<option value="">(Choose a Site)</option>');
    for (var j = 0; j < data.length; j++){                 
      select.append($('<option></option>').val(data[j].reference_designator).html(data[j].name));
    } 
  });
});

$('#site').on('change',function(){
  var site = $('#site').val();
  var instruments_url = '/instruments/index/' + site + '.json';
  $.get(instruments_url, function(data) {
    var select = $('#instrument');
    select.empty().prepend('<option value="">(Choose an Instrument)</option>');
    for (var j = 0; j < data.length; j++){                 
      select.append($('<option></option>').val(data[j].reference_designator).html(data[j].name));
    } 
  });
});

$('#instrument').on('change',function(){
  var instrument = $('#instrument').val();
  $('#reference-designator').html(instrument);
});

