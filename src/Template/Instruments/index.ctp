<h3>Instruments</h3>
<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th><?= $this->Paginator->sort('reference_designator') ?></th>
      <th><?= $this->Paginator->sort('name',['label'=>'Instrument Name']) ?></th>
      <th><?= $this->Paginator->sort('start_depth') ?></th>
      <th><?= $this->Paginator->sort('end_depth') ?></th>
      <th><?= $this->Paginator->sort('uframe_status',['label'=>'uFrame Status']) ?></th>
      <th><?= $this->Paginator->sort('current_status') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($instruments as $instrument): ?>
    <tr>
      <td><?= $this->html->link($instrument->reference_designator,['action'=>'view',$instrument->reference_designator]) ?> 
      <td><?= h($instrument->name) ?></td>
      <td><?= $this->Number->format($instrument->start_depth) ?></td>
      <td><?= $this->Number->format($instrument->end_depth) ?></td>
      <td> 
        <?php if ($instrument->uframe_status=='1') { ?>
          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> OK
        <?php } else { ?>
          <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
        <?php } ?>
      </td>
      <td> 
        <?php if ($instrument->current_status=='deployed') { ?>
          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color:green;"></span> Deployed
        <?php } elseif ($instrument->current_status=='recovered') { ?>
          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color:red;"></span> Recovered
        <?php } else { ?>
          <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Unknown
        <?php } ?>
      </td>
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
