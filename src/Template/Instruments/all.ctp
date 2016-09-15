<h3>Instruments</h3>

<table id="instruments" class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
        <th>Region</th>
        <th>Site</th>
        <th>Node</th>
        <th>Instrument</th>
        <th>Reference Designator</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
  </tfoot>
</table>

<div>
  <h5>Filter Options</h5>
  <dl id="actions" class="dl-horizontal"></dl>
</div>

<?php echo $this->Html->script('https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js', ['block' => true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
function format ( d ) {
  // `d` is the original data object for the row
  return '<a href="">'+d.reference_designator+'</a>';
}

$(document).ready(function() {
  
  $('#instruments').DataTable( {
    ajax: "/instruments.json",
    columns: [
      { "data": "region_name"},
      { "data": "site_name"},
      { "data": "node_name"},
      { "data": "name"},
      { "data": "reference_designator",
        "render": function (data, type, full, meta) {
          return type === 'display' ?
            '<a href="/instruments/view/'+data+'">'+data+'</a>' :
            data;
        }
      }
    ],
    deferRender: true,
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: true,
    //initComplete: function () {
    //  this.api().columns().every( function () {
    //    var column = this;
    //    col_title = $(column.header()).html();
    //    if (col_title != "Reference Designator") {
    //      var select = $('<select><option value=""></option></select>')
    //        .appendTo( $(column.footer()).empty() )
    //        .on( 'change', function () {
    //          var val = $.fn.dataTable.util.escapeRegex(
    //            $(this).val()
    //          );

    //          column
    //            .search( val ? '^'+val+'$' : '', true, false )
    //            .draw();
    //        } );

    //      column.data().unique().sort().each( function ( d, j ) {
    //        if(d) {
    //          select.append( '<option value="'+d+'">'+d+'</option>' )
    //        }
    //      } );
    //    }
    //  } );
    //},

  } );
  
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
