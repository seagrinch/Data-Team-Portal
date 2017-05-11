<?php 
  $icons = [
    'AVAILABLE' => [
      'icon'=>'glyphicon-ok-sign', 
      'title'=>'Available', 
      'color'=>'green'],
    'FAIL' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Fail', 
      'color'=>'red'],
    'NOT_AVAILABLE' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Not Available', 
      'color'=>'gray'],
    'NOT_EVALUATED' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Not Evaluated', 
      'color'=>'steelblue'],
    'NOT_OPERATIONAL' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Not Operational', 
      'color'=>'red'],
    'PENDING_INGEST' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Pending Ingest', 
      'color'=>'lightgray'],
    'SUSPECT' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Suspect', 
      'color'=>'orange'],
    '' => [
      'icon'=>'glyphicon-tag', 
      'title'=>'Unknown', 
      'color'=>'black'],
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
  <?php foreach ($annotations as $annotation): 
    if (array_key_exists($annotation->status,$icons)) {
      $icon = $icons[$annotation->status];
    } else {
      $icon = $icons[''];
    }
  ?>
  <tr>
    <td>
      <span class="glyphicon <?= $icon['icon']?>" style="font-size: 1.0em; color:<?= $icon['color']?>;" aria-hidden="true" title=<?=$icon['title']?>></span> 
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
      <?php if ($annotation->start_datetime): ?>
        <?= h($annotation->start_datetime) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?php if ($annotation->end_datetime): ?>
        <?= h($annotation->end_datetime) ?> 
      <?php endif; ?> 
    </td>
    <td>
      <?= $this->Text->autoParagraph(h($annotation->annotation)); ?>
      <?php if ($annotation->todo): ?>
        <span class="text-danger"><strong>Todo:</strong> <?= h($annotation->todo); ?></span>
      <?php endif; ?> 
      <p><small>
        <?php if ($annotation->reviewed_by): ?>
          <em>By <?= $annotation->reviewed_by ?>, 
        <?php endif; ?> 
        <?= $this->Time->timeAgoInWords($annotation->reviewed_date) ?></em>
        <?php if ($annotation->redmine_issue): 
          $issues = explode(',',$annotation->redmine_issue);
        ?>
          <br />
          <strong>Redmine Issue</strong> 
          <?php foreach ($issues as $issue): ?>
          <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $issue?>">#<?= trim($issue)?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a>
          <?php endforeach; ?> 
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
