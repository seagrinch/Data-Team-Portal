<h2>Educational Data Nuggets</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('title') ?></th>
      <th><?= $this->Paginator->sort('start_date') ?></th>
      <th><?= $this->Paginator->sort('end_date') ?></th>
      <th><?= $this->Paginator->sort('science_theme') ?></th>
      <th><?= $this->Paginator->sort('science_concept') ?></th>
      <th><?= $this->Paginator->sort('status') ?></th>
      <th><?= $this->Paginator->sort('modified') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($nuggets as $nugget): ?>
    <tr>
      <td><?= $this->Html->link($nugget->title, ['action' => 'view', $nugget->id]) ?></td>
      <td><?= h($nugget->start_date) ?></td>
      <td><?= h($nugget->end_date) ?></td>
      <td><?= h($nugget->science_theme) ?></td>
      <td><?= h($nugget->science_concept) ?></td>
      <td><?= h($nugget->status) ?></td>
      <td><?= h($nugget->modified) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php echo $this->Html->link('<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> New Nugget', ['action'=>'add'], ['class'=>'btn btn-primary', 'escape'=>false]); ?>
</div>

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('first')) ?>
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
    <?= $this->Paginator->last(__('last') . ' >>') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>


<?php //$this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
