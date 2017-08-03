<h3>Assets</h3>

<table id="assets" class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
        <th>UID</th>
        <th>Type</th>
        <th>Manufacturer</th>
        <th>Model</th>
        <th>Serial</th>
        <th>Description</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
  </tfoot>
</table>

<?php echo $this->Html->script('https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js', ['block' => true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function() {
  
  $('#assets').DataTable( {
    ajax: "/assets.json",
    columns: [
      { "data": "asset_uid",
        "render": function (data, type, full, meta) {
          return type === 'display' ?
            '<a href="/assets/view/'+data+'">'+data+'</a>' :
            data;
        }
      },
      { "data": "type"},
      { "data": "manufacturer"},
      { "data": "model"},
      { "data": "manufacturer_serial_no"},
      { "data": "description_of_equipment"},
    ],
    deferRender: true,
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: true,
  } );
  
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
