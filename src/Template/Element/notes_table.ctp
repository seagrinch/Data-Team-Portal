<?php 
  $icons = [
    'note' => ['icon'=>'glyphicon-tag', 'title'=>'Operational Note', 'color'=>'black'],
    'annotation' => ['icon'=>'glyphicon-globe', 'title'=>'Annotation', 'color'=>'green'],
    'issue' => ['icon'=>'glyphicon-question-sign', 'title'=>'Issue', 'color'=>'red'],
    'resolved' => ['icon'=>'glyphicon-ok-sign', 'title'=>'Resolved Flag', 'color'=>'black'],
  ];
?>
<?php if (count($notes)>0): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Type</th>
      <th>Metadata</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($notes as $note): ?>
  <tr>
    <td><span class="glyphicon <?= $icons[$note->type]['icon']?>" style="font-size: 1.0em; color:<?= $icons[$note->type]['color']?>;" aria-hidden="true"></span> <?= $icons[$note->type]['title']?></td>

    <td>
      <?php if ($note->method): ?>
        Method: <?= h($note->method)?> <br>
      <?php endif; ?>
      <?php if ($note->stream): ?>
        Stream: <?= h($note->stream)?> <br>
      <?php endif; ?>
      <?php if ($note->parameter): ?>
        Parameter: <?= h($note->parameter)?> <br>
      <?php endif; ?>
      <?php if ($note->deployment): ?>
        Deployment: <?= h($note->deployment) ?> <br>
      <?php endif; ?> 
      <?php if ($note->start_date): ?>
        <?= h($note->start_date) ?> 
      <?php endif; ?> 
      <?php if ($note->end_date): ?>
        to <?= h($note->end_date) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?= $this->Text->autoParagraph(h($note->comment)); ?>
      <p><small>
        <em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
        <?= $this->Time->timeAgoInWords($note->created) ?></em>
        <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
          [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
        <?php endif; ?>
        <?php if ($note->redmine_issue): ?>
          <br>
          <strong>Redmine Issue</strong> <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
        <?php endif; ?> 
        <?php if ($note->resolved_date): ?>
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
