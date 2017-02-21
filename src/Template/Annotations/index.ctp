<h3>Annotations</h3>
  Sort by:
<div class="btn-group" role="group" aria-label="...">
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Annotations.reference_designator' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('reference_designator') ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Users.first_name' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Users.first_name') ?></li>
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Annotations.created' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('created') ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Annotations.type' ? 'active' : '') ?>">
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
    <?php foreach ($annotations as $annotation): ?>
    <tr <?= ($annotation->type=='flag') ? 'class="warning"' : '' ?>>
      <td><?= $this->Html->link($annotation->reference_designator,['controller'=>$annotation->model,'action'=>'view',$annotation->reference_designator]) ?></td>
      <td>
        <?php //echo $this->Text->autoParagraph(h($annotation->body)); ?>
        <?= $this->Text->truncate($annotation->comment, 500, ['exact'=>false,'ellipsis'=>'...']); ?>
        <p>
          <small><em>By <?= $annotation->has('user') ? h($annotation->user->full_name) : 'Unknown' ?>, 
          <?= $this->Time->timeAgoInWords($annotation->created) ?></em>
          <?php if ($this->request->session()->read('Auth.User.id') == $annotation->user_id): ?>
            [<?php echo $this->Html->link('Edit', ['controller'=>'annotations','action'=>'edit',$annotation->id]); ?>]
          <?php endif; ?>
          </small>
        </p>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- <p class="text-right"><?php echo $this->Html->link(__('Add a New Annotation'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p> -->

<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('previous')) ?>
    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
    <?= $this->Paginator->next(__('next') . ' >') ?>
  </ul>
  <p><?= $this->Paginator->counter() ?></p>
</div>

