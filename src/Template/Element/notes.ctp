<?php 
  $icons = [
    'note' => ['icon'=>'glyphicon-tag', 'title'=>'Operational Note', 'color'=>'black'],
    'annotation' => ['icon'=>'glyphicon-globe', 'title'=>'Annotation', 'color'=>'green'],
    'issue' => ['icon'=>'glyphicon-question-sign', 'title'=>'Issue', 'color'=>'red'],
    'resolved' => ['icon'=>'glyphicon-ok-sign', 'title'=>'Resolved Flag', 'color'=>'black'],
  ];
?>
<?php if (count($notes)>0): ?>
<?php foreach ($notes as $note): ?>

<div class="media">
  <div class="media-left">
    
    <span class="glyphicon <?= $icons[$note->type]['icon']?>" style="font-size: 1.6em; color:<?= $icons[$note->type]['color']?>;" aria-hidden="true"></span>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= $icons[$note->type]['title']?>
      <small>
        <?php if ($note->deployment): ?>
          Deployment: <?= h($note->deployment) ?> 
        <?php endif; ?> 
        <?php if ($note->start_date): ?>
          <?= h($note->start_date) ?> to <?= h($note->end_date) ?> 
        <?php endif; ?> 
      </small></h4>

    <?= $this->Text->autoParagraph(h($note->comment)); ?>
    <p><small>
      <em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
      <?= $this->Time->timeAgoInWords($note->created) ?></em>
      <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
        [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
      <?php endif; ?>

      <?php if ($note->redmine_issue): ?>
        <br>
        Redmine Issue <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
      <?php endif; ?> 
    </small></p>
    <?php if ($note->resolved_date): ?>
      <p><strong>Resolved: </strong><?= h($note->resolved_date) ?> </p>
    <?php endif; ?> 
    <?php if ($note->resolved_comment): ?>
      <?= $this->Text->autoParagraph(h($note->resolved_comment)); ?> 
    <?php endif; ?> 
    
    <hr>

  </div>
</div>

<?php endforeach; ?>
<?php else: ?>
  <p>No notes yet.</p>
<?php endif; ?>
