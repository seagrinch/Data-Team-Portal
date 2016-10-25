<h3>OOI Streams</h3>

<table id="streams" class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Stream Content</th>
        <th>Stream Type</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
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
  
  $('#streams').DataTable( {
    ajax: "/streams.json",
    columns: [
      { "data": "id"},
      { "data": "name",
        "render": function (data, type, full, meta) {
          return type === 'display' ?
            '<a href="/streams/view/'+data+'">'+data+'</a>' :
            data;
        }
      },
      { "data": "stream_content"},
      { "data": "stream_type"},
    ],
    deferRender: true,
    pageLength: 10,
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    stateSave: true,

  } );
  
} );

<?php $this->Html->scriptEnd(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
