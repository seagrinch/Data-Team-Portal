<?php 
  $icons = [
    '' => ['icon'=>'glyphicon-tag', 'title'=>'Unknown', 'color'=>'black'],
    'note' => ['icon'=>'glyphicon-tag', 'title'=>'Operational Note', 'color'=>'black'],    
    'annotation' => ['icon'=>'glyphicon-pencil', 'title'=>'Annotation', 'color'=>'blue'], //globe
    'exclusion' => ['icon'=>'glyphicon-fire', 'title'=>'Exclusion', 'color'=>'red'], //exclamation-sign, thumbs-down
    'comment' => ['icon'=>'glyphicon-asterisk', 'title'=>'Comment', 'color'=>'black'],
    'issue' => ['icon'=>'glyphicon-remove-sign', 'title'=>'Open Issue', 'color'=>'red'],
    'resolved' => ['icon'=>'glyphicon-ok-sign', 'title'=>'Resolved Issue', 'color'=>'green'],
  ];
?>
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
  <tr>
    <td>  
      <span class="glyphicon <?= $icons[$note->type]['icon']?>" style="font-size: 1.0em; color:<?= $icons[$note->type]['color']?>;" aria-hidden="true" title="<?= $icons[$note->type]['title']?>"></span> 
      <small><?= $this->Ooi->rdLink($note->reference_designator) ?><br />
      <?php if ($note->deployment): ?>
        <strong>Deployment:</strong> <?= h($note->deployment) ?> <br />
      <?php endif; ?> 
      <?php if ($note->asset_uid): ?>
        <strong>Asset:</strong> <?= $this->Ooi->assetLink($note->asset_uid) ?> <br />
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
      <?= $this->Text->autoParagraph(h($note->comment)); ?>
      <p><small>
        <em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
        <?= $this->Time->timeAgoInWords($note->created) ?></em>
        <?php if (($this->request->session()->read('Auth.User.id') == $note->user_id) | ($this->request->session()->read('Auth.User.role')=='admin')): ?>
          [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
        <?php endif; ?>
        <?php if ($note->redmine_issue): ?>
          <br />
          <strong>Redmine Issue</strong> <a href="https://redmine.oceanobservatories.org/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
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
