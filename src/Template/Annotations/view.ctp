<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Annotations'), ['controller'=>'annotations', 'action' => 'index']) ?></li>
  <li class="active"><?= h($annotation->id) ?></li>
</ol>

<?php 
  $session = $this->request->session();
  if ($session->read('Auth.User.id')==$annotation->user_id) { 
    echo $this->Html->link('Edit Annotation', ['action'=>'edit', $annotation->id], ['class'=>'btn btn-info pull-right']);
  }
?>

<h3>Annotation #<?= h($annotation->id) ?></h3>
<dl class="dl-horizontal">
  <dt><?= __('User') ?></dt>
  <dd><?= $annotation->has('user') ? $this->Html->link($annotation->user->username, ['controller' => 'Users', 'action' => 'view', $annotation->user->id]) : '' ?></dd>
  <dt><?= __('Type') ?></dt>
  <dd><?= h($annotation->type) ?></dd>
  <dt><?= __('Model') ?></dt>
  <dd><?= h($annotation->model) ?></dd>
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($annotation->reference_designator) ?></dd>
  <dt><?= __('Comment') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($annotation->comment)); ?></dd>
  <dt><?= __('Deployment') ?></dt>
  <dd><?= h($annotation->deployment) ?></dd>
  <dt><?= __('Start Date') ?></dt>
  <dd><?= h($annotation->start_date) ?></dd>
  <dt><?= __('End Date') ?></dt>
  <dd><?= h($annotation->end_date) ?></dd>
  <dt><?= __('Redmine Issue') ?></dt>
  <dd><?= h($annotation->redmine_issue) ?></dd>
  <dt><?= __('Resolved Date') ?></dt>
  <dd><?= h($annotation->resolved_date) ?></dd>
  <dt><?= __('Resolved Comment') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($annotation->resolved_comment)); ?></dd>
  <dt><?= __('Created') ?></dt>
  <dd><?= h($annotation->created) ?></dd>
  <dt><?= __('Modified') ?></dt>
  <dd><?= h($annotation->modified) ?></dd>
</dl>
