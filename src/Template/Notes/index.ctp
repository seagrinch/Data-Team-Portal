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


<?php echo $this->element('notes_table', ['notes'=>$notes]); ?>

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
