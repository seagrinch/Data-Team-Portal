<h3>Import Log</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('id') ?></th>
      <th scope="col"><?= $this->Paginator->sort('name') ?></th>
      <th scope="col"><?= $this->Paginator->sort('import_date') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($importLog as $importLog): ?>
    <tr>
      <td><?= $this->Number->format($importLog->id) ?></td>
      <td><?= h($importLog->name) ?></td>
      <td><?= h($importLog->import_date) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
