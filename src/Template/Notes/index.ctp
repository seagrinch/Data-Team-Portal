<?php 
  $sort_key = $this->Paginator->sortKey();
  $type = $this->Paginator->sortDir() === 'asc' ? 'up' : 'down';
  function sortArrows($key, $title, $sort_key, $type) {
    if($key == $sort_key) {
      $icon = "&nbsp;<span class='glyphicon glyphicon-menu-" . $type . "' aria-hidden='true'></span>";
      return $title . " " . $icon;
    } else {
      return $title;
    }
  }
?>
<h3>Notes</h3>
  Sort by:
<div class="btn-group" role="group" aria-label="...">
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.reference_designator' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Notes.reference_designator', sortArrows('Notes.reference_designator', 'Reference Designator', $sort_key, $type), array('escape' => false)) ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Users.first_name' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Users.first_name', sortArrows('Users.first_name', 'First Name', $sort_key, $type), array('escape' => false)) ?></li>
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.created' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Notes.created', sortArrows('Notes.created', 'Created', $sort_key, $type), array('escape' => false)) ?></li> 
  <li class="btn btn-default <?= ($this->Paginator->sortKey()=='Notes.modified' ? 'active' : '') ?>">
    <?= $this->Paginator->sort('Notes.modified', sortArrows('Notes.modified', 'Modified', $sort_key, $type), array('escape' => false)) ?></li> 
</div>

<?php if ($notes->count()>0): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Metadata</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($notes as $note): ?>
  <tr <?= ($note->status=='Open Issue') ? 'class="warning"' : '' ?>>
    <td>
      <span class="glyphicon glyphicon-tag" style="font-size: 1.0em; color:black;" aria-hidden="true"></span> 
      <small><?= $this->Html->link($note->reference_designator,['controller'=>$note->model,'action'=>'view',$note->reference_designator]) ?><br />
      <?php if ($note->deployment): ?>
        <strong>Deployment:</strong> <?= h($note->deployment) ?> <br />
      <?php endif; ?> 
      <?php if ($note->asset_uid): ?>
        <strong>Asset ID:</strong> <?= h($note->asset_uid) ?> <br />
      <?php endif; ?> 
      <?php if ($note->status): ?>
        <strong>Status:</strong> <?= h($note->status) ?> <br />
      <?php endif; ?> 
      </small>
    </td>
    <td>
      <?php if ($note->start_date): ?>
        <?= h($note->start_date) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?php if ($note->end_date): ?>
        <?= h($note->end_date) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?php echo $this->Text->truncate($note->comment, 500, ['exact'=>false,'ellipsis'=>'...']); ?>
      <?php //echo $this->Text->autoParagraph(h($note->comment)); ?>
      <p><small>
        <em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
        <?= $this->Time->timeAgoInWords($note->created) ?></em>
        <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
          [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
        <?php endif; ?>
        <?php if ($note->redmine_issue): ?>
          <br />
          <strong>Redmine Issue</strong> <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
        <?php endif; ?> 
        <?php if ($note->resolved_date): ?>
          <br />
          <strong>Resolved: </strong><?= h($note->resolved_date) ?>
        <?php endif; ?> 
      </small></p>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>    

<?php else: ?>
  <p>No notes yet.</p>
<?php endif; ?>


<!-- <p class="text-right"><?php echo $this->Html->link(__('Add a New Note'), ['action'=>'add'], ['class'=>'btn btn-primary']); ?></p> -->

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
