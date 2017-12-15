<?php 
  $icons = [
    'available' => [
      'icon'=>'glyphicon-ok-sign', 
      'title'=>'Available', 
      'color'=>'green'],
    'fail' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Fail', 
      'color'=>'red'],
    'not_available' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Not Available', 
      'color'=>'gray'],
    'not_evaluated' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Not Evaluated', 
      'color'=>'steelblue'],
    'not_operational' => [
      'icon'=>'glyphicon-remove', 
      'title'=>'Not Operational', 
      'color'=>'red'],
    'pending_ingest' => [
      'icon'=>'glyphicon-question-sign', 
      'title'=>'Pending Ingest', 
      'color'=>'lightgray'],
    'suspect' => [
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
    if (array_key_exists($annotation->qcFlag,$icons)) {
      $icon = $icons[$annotation->qcFlag];
    } else {
      $icon = $icons[''];
    }
  ?>
  <tr>
    <td>
      <span class="glyphicon <?= $icon['icon']?>" style="font-size: 1.0em; color:<?= $icon['color']?>;" aria-hidden="true" title="<?=$icon['title']?>"></span> 
      <small><?=$annotation->reference_designator?><br />
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
          <strong>Id:</strong> <?= $annotation->id ?></em> 
        <?php if ($annotation->source): ?>
          <strong>By:</strong> <?= explode('@',$annotation->source)[0] ?></em>
        <?php endif; ?> 
        <?php if ($annotation->qcFlag): ?>
          <br />
          <strong>Flag:</strong> <?=h($annotation->qcFlag)?> 
          <strong>Exclude:</strong> <?=($annotation->exclusionFlag?'Yes':'No')?>
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
