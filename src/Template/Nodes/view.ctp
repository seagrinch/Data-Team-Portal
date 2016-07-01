<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Arrays'), ['controller'=>'regions', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($node->site->region->name,['controller'=>'regions','action'=>'view',$node->site->region->reference_designator]) ?></li>
  <li><?= $this->html->link($node->site->name,['controller'=>'sites','action'=>'view',$node->site->reference_designator]) ?></li>
  <li class="active"><?= h($node->name) ?></li>
</ol>

<h3><?= h($node->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($node->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $node->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($node->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($node->longitude) ?></dd>
  <dt><?= __('Depth') ?></dt>
  <dd><?= $this->Number->format($node->end_depth) ?></dd>
</dl>

<h3>Instruments</h3>
<ul>
  <?php foreach ($node->instruments as $instrument): ?>
  <li><?= $this->html->link($instrument->name,['controller'=>'instruments','action'=>'view',$instrument->reference_designator]) ?> <small>(<?= h($instrument->reference_designator) ?>)</small></li>
  <?php endforeach; ?>
</ul>

<div class="row">
  <div class='col-md-9'>
    
    <h3>Notes</h3>
    <?php if (count($node->notes)>0): ?>
      <?php foreach ($node->notes as $note): ?>
        <div class="well">
          <div>
            <?php if ($note->type=='flag'): ?>
              <span class="glyphicon glyphicon-flag" style="color:red;" aria-hidden="true"></span>
            <?php endif; ?> 
            <?php if ($note->redmine_issue): ?>
              <a href="https://uframe-cm.ooi.rutgers.edu/issues/<?= $note->redmine_issue?>">#<?= $note->redmine_issue?></a> 
            <?php endif; ?> 
            <?php if ($note->start_date): ?>
              Annotation Range: <?= h($note->start_date) ?> to <?= h($note->end_date) ?> 
            <?php endif; ?> 
            <?php if ($note->resolved): ?>
              Resolved: <?= h($note->resolved) ?> 
            <?php endif; ?> 
          </div>
          <?= $this->Text->autoParagraph(h($note->comment)); ?>
          <p>
            <small><em>By <?= $note->has('user') ? h($note->user->full_name) : 'Unknown' ?>, 
            <?= $this->Time->timeAgoInWords($note->created) ?></em>
            <?php if ($this->request->session()->read('Auth.User.id') == $note->user_id): ?>
              [<?php echo $this->Html->link('Edit', ['controller'=>'notes','action'=>'edit',$note->id]); ?>]
            <?php endif; ?>
            </small>
          </p>
          <?php if ($note->resolved_comment): ?>
          <p><strong>Resolved Comment</strong></p>
            <?= $this->Text->autoParagraph(h($note->resolved_comment)); ?> 
          <?php endif; ?> 
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No notes yet.</p>
    <?php endif; ?>
    <p class="text-left"><?php echo $this->Html->link(__('Add a New Note'), ['controller'=>'notes','action'=>'add','nodes',$node->reference_designator], ['class'=>'btn btn-primary']); ?></p>
    
  </div>
</div>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($site);
*/
?>