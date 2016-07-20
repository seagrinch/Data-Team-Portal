<h3>Notes</h3>
  Sort by:
<div class="btn-group" role="group" aria-label="...">
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.reference_designator' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('reference_designator') ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Users.first_name' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Users.first_name') ?></li>
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.created' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('created') ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.type' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('type') ?></li>
</div>

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
        <?= $this->Text->truncate($note->comment, 500, ['exact'=>false,'ellipsis'=>'...']); ?>
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

