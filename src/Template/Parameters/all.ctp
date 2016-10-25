<h3>OOI Parameters</h3>

<table id="parameters" class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Display Name</th>
        <th>Unit</th>
        <th>Identifier</th>
        <th>Type</th>
        <th>Level</th>
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
$(document).ready(function() {
  
  $('#parameters').DataTable( {
    ajax: "/parameters.json",
    columns: [
      { "data": "id",
        "render": function (data, type, full, meta) {
          return type === 'display' ?
            '<a href="/parameters/view/'+data+'">'+data+'</a>' :
            data;
        }
      },
      { "data": "name"},
      { "data": "display_name"},
      { "data": "unit"},
      { "data": "data_product_identifier"},
      { "data": "data_product_type"},
      { "data": "data_level"},
    ],
    deferRender: true,
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: true,

  } );
  
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
