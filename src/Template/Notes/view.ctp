<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Notes'), ['controller'=>'notes', 'action' => 'index']) ?></li>
  <li class="active"><?= h($note->id) ?></li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->check('Auth.User')) { 
    echo $this->Html->link('Edit Note', ['action'=>'edit', $note->id], ['class'=>'btn btn-info pull-right']);
  }
?>

<h3>Note #<?= h($note->id) ?></h3>
<dl class="dl-horizontal">
  <dt><?= __('User') ?></dt>
  <dd><?= $note->has('user') ? $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($note->model) ?></dd>
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($note->reference_designator) ?></dd>
  <dt><?= __('Comment') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($note->comment)); ?></dd>
  <dt><?= __('Type') ?></dt>
  <dd><?= h($note->type) ?></dd>
  <dt><?= __('Start Date') ?></dt>
  <dd><?= h($note->start_date) ?></dd>
  <dt><?= __('End Date') ?></dt>
  <dd><?= h($note->end_date) ?></dd>
  <dt><?= __('Redmine Issue') ?></dt>
  <dd><?= h($note->redmine_issue) ?></dd>
  <dt><?= __('Resolved Date') ?></dt>
  <dd><?= h($note->resolved_date) ?></dd>
  <dt><?= __('Resolved Comment') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($note->resolved_comment)); ?></dd>
  <dt><?= __('Created') ?></dt>
  <dd><?= h($note->created) ?></dd>
  <dt><?= __('Modified') ?></dt>
  <dd><?= h($note->modified) ?></dd>
</dl>
