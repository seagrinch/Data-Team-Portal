<h3>Notes</h3>
<p>Sort by: <?= $this->Paginator->sort('reference_designator') ?> | 
  <?= $this->Paginator->sort('User.full_name',['label'=>'Name']) ?> | 
  <?= $this->Paginator->sort('created') ?> | 
  <?= $this->Paginator->sort('type') ?>
</p>

<table class="table table-striped" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <th>Reference Designator</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($notes as $note): ?>
    <tr <?= ($note->type=='flag') ? 'class="warning"' : '' ?>>
      <td><?= $this->Html->link($note->reference_designator,['controller'=>$note->model,'action'=>'view',$note->reference_designator]) ?></td>
      <td>
        <?php //echo $this->Text->autoParagraph(h($note->body)); ?>
        <?= $this->Text->truncate($note->body, 500, ['exact'=>false,'ellipsis'=>'...']); ?>
        <p>
          <small><em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
          <?= $this->Time->timeAgoInWords($note->created) ?></em>
          <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
            [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
          <?php endif; ?>
          </small>
        </p>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- <p class="text-right"><?php echo $this->Html->link(__('Add a New Note'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p> -->

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>

