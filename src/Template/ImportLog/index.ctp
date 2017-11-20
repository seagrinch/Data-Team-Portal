<h3>Import Log</h3>
<p>When data tables in this system are updated from their source repositories, the last import date is updated here.  </p>
<p>For more information about the source reporsitories, please see the <a href="/pages/reference">Reference page</a>.</p>
<table class="table table-striped table-hover" style="width: auto;">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('name') ?></th>
      <th scope="col"><?= $this->Paginator->sort('import_date') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($importLog as $importLog): ?>
    <tr>
      <td><?= h($importLog->name) ?></td>
      <td><?= h($importLog->import_date) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
