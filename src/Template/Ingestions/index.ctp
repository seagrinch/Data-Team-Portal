<h3>Ingestions</h3>
<?php echo $this->Form->create('ingestion', ['valueSources' => ['query', 'context'], 'type' => 'get', 'align'=>'inline']); ?>
<strong>Filter:</strong> <?php echo $this->Form->select('region', [
  'CE'=>'Coastal Endurance',
  'CP'=>'Coastal Pioneer',
  'GA'=>'Global Argentine Basin',
  'GI'=>'Global Irminger Sea',
  'GP'=>'Global Station Papa',
  'GS'=>'Global Southern Ocean',
  'RS'=>'Cabled Array'],
  ['empty'=>'All Arrays']); ?>  
<?php echo $this->Form->select('status', [
  'Not Deployed'=>'Not Deployed',
  'Not Expected'=>'Not Expected',
  'Missing'=>'Missing',
  'Expected'=>'Expected',
  'Pending'=>'Pending',
  'Available'=>'Available'],
  ['empty'=>'Any Status']); ?>  
<?php echo $this->Form->button('Go',['class'=>'btn-primary']); ?>
<?php echo $this->Form->end(); ?>

<table class="table table-striped table-hover table-condensed" style="width: auto;">
  <thead>
    <tr>
      <th scope="col"><?= $this->Paginator->sort('reference_designator') ?></th>
      <th scope="col"><?= $this->Paginator->sort('deployment') ?></th>
      <th scope="col"><?= $this->Paginator->sort('method') ?></th>
      <th scope="col"><?= $this->Paginator->sort('status') ?></th>
      <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ingestions as $ingestion): ?>
    <tr>
      <td><?= h($ingestion->reference_designator) ?></td>
      <td><?= h($ingestion->deployment) ?></td>
      <td><?= h($ingestion->method) ?></td>
      <td><?= h($ingestion->status) ?></td>
      <td><?= h($ingestion->notes) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

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
