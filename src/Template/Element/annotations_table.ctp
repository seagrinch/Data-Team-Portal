<?php 
  $icons = [
    'note' => ['icon'=>'glyphicon-tag', 'title'=>'Operational Note', 'color'=>'black'],
    'annotation' => ['icon'=>'glyphicon-globe', 'title'=>'Annotation', 'color'=>'green'],
    'issue' => ['icon'=>'glyphicon-question-sign', 'title'=>'Issue', 'color'=>'red'],
    'resolved' => ['icon'=>'glyphicon-ok-sign', 'title'=>'Resolved Flag', 'color'=>'black'],
  ];
?>
<?php if ($annotations->count()>0): ?>
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
  <?php foreach ($annotations as $annotation): ?>
  <tr>
    <td>
      <span class="glyphicon <?= $icons[$annotation->type]['icon']?>" style="font-size: 1.0em; color:<?= $icons[$annotation->type]['color']?>;" aria-hidden="true"></span> 
      <small><?=$annotation->reference_designator?><br />
      <?php if ($annotation->status): ?>
        <strong>Status:</strong> <?= h($annotation->status) ?> <br />
      <?php endif; ?> 
      <?php if ($annotation->deployment): ?>
        <strong>Deployment:</strong> <?= h($annotation->deployment) ?> <br />
      <?php endif; ?> 
      <?php if ($annotation->method): ?>
        <strong>Method:</strong> <?= h($annotation->method)?> <br />
      <?php endif; ?>
      <?php if ($annotation->stream): ?>
        <strong>Stream:</strong> <?= h($annotation->stream)?> <br />
      <?php endif; ?>
      <?php if ($annotation->parameter): ?>
        <strong>Parameter:</strong> <?= h($annotation->parameter)?> <br />
      <?php endif; ?>
      </small>
    </td>
    <td>
      <?php if ($annotation->start_date): ?>
        <?= h($annotation->start_date) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?php if ($annotation->end_date): ?>
        <?= h($annotation->end_date) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?= $this->Text->autoParagraph(h($annotation->comment)); ?>
      <p><small>
        <em>By <?= $annotation->has('user') ? h($annotation->user->full_name) : 'Unknown' ?>, 
        <?= $this->Time->timeAgoInWords($annotation->created) ?></em>
        <?php if ($this->request->session()->read('Auth.User.id') == $annotation->user_id): ?>
          [<?php echo $this->Html->link('Edit', ['controller'=>'annotations','action'=>'edit',$annotation->id]); ?>]
        <?php endif; ?>
        <?php if ($annotation->redmine_issue): ?>
          <br />
          <strong>Redmine Issue</strong> <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $annotation->redmine_issue?>">#<?= $annotation->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
        <?php endif; ?> 
        <?php if ($annotation->resolved_date): ?>
          <br />
          <strong>Resolved: </strong><?= h($annotation->resolved_date) ?>
        <?php endif; ?> 
      </small></p>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>    

<?php else: ?>
  <p>No annotations yet.</p>
<?php endif; ?>
