<ol class="breadcrumb">
  <li><?= $this->Html->link('Users', ['controller'=>'users', 'action'=>'index']) ?></li>
  <li class="active"><?= h($user->full_name) ?></li>
</ol>

<?php if ($this->request->session()->read('Auth.User.id') == $user->id): ?>
<p class="pull-right"><?php echo $this->Html->link('Edit your Profile', ['controller'=>'Users', 'action'=>'update'], ['class'=>'btn btn-info']);?></p>
<?php endif; ?>

<h3><?= h($user->full_name) ?></h3>
<dl class="dl-horizontal">
  <dt><?= __('Email') ?></dt>
  <dd><?= h($user->email) ?></dd>
  <dt><?= __('Role') ?></dt>
  <dd><?= h($user->role) ?></dd>
</dl>    

<h3>Pending Issues</h3>
<?php if ($user->notes->count()>0): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Instrument</th>
      <th>Comment</th>
      <th>Redmine Issue</th>
      <th>Last Modified</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($user->notes as $note): ?>
  <tr>
    <td><?= $this->Html->link($note->reference_designator,['controller'=>$note->model,'action'=>'view',$note->reference_designator,'#'=>'notes']) ?></td>
    <td>
      <?php echo $this->Text->truncate($note->comment, 100, ['exact'=>false,'ellipsis'=>'...']); ?>
    </td>
    <td>
      <?php if ($note->redmine_issue): ?>
        <a href="https://redmine.oceanobservatories.org/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?> <span class="glyphicon glyphicon-link" aria-hidden="true"></span></a> 
      <?php endif; ?>     
    </td>
    <td>
      <?= $this->Time->timeAgoInWords($note->created) ?>
    </td>
    <td>
      <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
        <?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['controller'=>'notes','action'=>'edit',$note->id],['escape'=>false,'title'=>'Edit']); ?>
      <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>    
<?php else: ?>
  <p>No pending issues.</p>
<?php endif; ?>


<h3>Pending Cruise Reviews</h3>
<?php if ($user->cruise_reviews->count()>0): ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Cruise ID</th>
      <th>Start Date</th>
      <th>Note</th>
      <th>Status</th>
      <th>Last Modified</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($user->cruise_reviews as $cr): ?>
  <tr>
    <td><?= $this->Html->link($cr->cruise_cuid,['controller'=>'CruiseReviews','action'=>'view',$cr->cruise_cuid]) ?></td>
    <td><?= h($cr->cruise->cruise_start_date)?></td>
    <td><?= h($cr->cruise->notes)?></td>
    <td><?= h($cr->status)?></td>
    <td><?= h($cr->modified)?></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>    
<?php else: ?>
  <p>No pending reviews.</p>
<?php endif; ?>
