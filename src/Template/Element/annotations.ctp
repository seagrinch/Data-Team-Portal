<?php 
  $icons = [
    'note' => ['icon'=>'glyphicon-tag', 'title'=>'Operational Note', 'color'=>'black'],
    'annotation' => ['icon'=>'glyphicon-globe', 'title'=>'Annotation', 'color'=>'green'],
    'issue' => ['icon'=>'glyphicon-question-sign', 'title'=>'Issue', 'color'=>'red'],
    'resolved' => ['icon'=>'glyphicon-ok-sign', 'title'=>'Resolved Flag', 'color'=>'black'],
  ];
?>
<?php if (count($annotations)>0): ?>
<?php foreach ($annotations as $annotation): ?>

<div class="media">
  <div class="media-left">
    
    <span class="glyphicon <?= $icons[$annotation->type]['icon']?>" style="font-size: 1.6em; color:<?= $icons[$annotation->type]['color']?>;" aria-hidden="true"></span>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= $icons[$annotation->type]['title']?>
      <small>
        <?php if ($annotation->deployment): ?>
          Deployment: <?= h($annotation->deployment) ?> 
        <?php endif; ?> 
        <?php if ($annotation->start_date): ?>
          <?= h($annotation->start_date) ?> to <?= h($annotation->end_date) ?> 
        <?php endif; ?> 
      </small></h4>

    <?= $this->Text->autoParagraph(h($annotation->comment)); ?>
    <p><small>
      <em>By <?= $annotation->has('user') ? h($annotation->user->full_name) : 'Unknown' ?>, 
      <?= $this->Time->timeAgoInWords($annotation->created) ?></em>
      <?php if ($this->request->session()->read('Auth.User.id') == $annotation->user_id): ?>
        [<?php echo $this->Html->link('Edit', ['controller'=>'annotations','action'=>'edit',$annotation->id]); ?>]
      <?php endif; ?>

      <?php if ($annotation->redmine_issue): ?>
        <br>
        Redmine Issue <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $annotation->redmine_issue?>">#<?= $annotation->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
      <?php endif; ?> 
    </small></p>
    <?php if ($annotation->resolved_date): ?>
      <p><strong>Resolved: </strong><?= h($annotation->resolved_date) ?> </p>
    <?php endif; ?> 
    <?php if ($annotation->resolved_comment): ?>
      <?= $this->Text->autoParagraph(h($annotation->resolved_comment)); ?> 
    <?php endif; ?> 
    
    <hr>

  </div>
</div>

<?php endforeach; ?>
<?php else: ?>
  <p>No annotations yet.</p>
<?php endif; ?>
