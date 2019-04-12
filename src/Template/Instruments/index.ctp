<h3>Instruments</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('region') ?></th>
      <th><?= $this->Paginator->sort('site') ?></th>
      <th><?= $this->Paginator->sort('name',['label'=>'Instrument Name']) ?></th>
      <th><?= $this->Paginator->sort('start_depth',['label'=>'Start']) ?></th>
      <th><?= $this->Paginator->sort('end_depth',['label'=>'End']) ?></th>
      <th><?= $this->Paginator->sort('dependency',['label'=>'Dep']) ?></th>
      <th><?= $this->Paginator->sort('current_status') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instruments as $instrument): ?>
    <tr>
      <td><?= $this->html->link($instrument->reference_designator,['action'=>'report',$instrument->reference_designator]) ?> 
      <td><?= h($instrument->node->site->region->reference_designator) ?></td>
      <td><?= h($instrument->node->site->name) ?></td>
      <td><?= h($instrument->name) ?></td>
      <td><?= $this->Number->format($instrument->start_depth) ?></td>
      <td><?= $this->Number->format($instrument->end_depth) ?></td>
      <td><?php 
        if (!empty($instrument->dependency)) {
          echo $this->html->link('<span class="glyphicon glyphicon-grain" style="font-size: 1.0em;" aria-hidden="true" title="<?=$instrument->dependency?>"></span>',['action'=>'report',$instrument->dependency],['escape'=>false]);
        }?>
      </td>
      <td><?= $this->element('instrument_status', ['status'=>$instrument->current_status]);?></td>
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
