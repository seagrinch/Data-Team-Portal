<ol class="breadcrumb">
  <li class="active">Test Questions</li>
</ol>

<h3><?= __('Test Questions') ?></h3>
<table class="table table-striped table-condensed table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('question') ?></th>
            <th><?= $this->Paginator->sort('type') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($testQuestions as $testQuestion): ?>
        <tr>
            <td><?= $this->Number->format($testQuestion->id) ?></td>
            <td><?= h($testQuestion->question) ?> <?= $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['action' => 'edit', $testQuestion->id],['escape'=>false]) ?></td>
            <td><?= h($testQuestion->type) ?></td>
            <td><?= h($testQuestion->modified) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="text-right"><?php echo $this->Html->link(__('Add a New Question'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p>

<div class="paginator">
  <ul class="pagination">
      <?= $this->Paginator->prev('< ' . __('previous')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>
