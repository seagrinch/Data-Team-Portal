<?php $this->assign('title',$nugget->title)?>
<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Nuggets'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($nugget->title) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php 
      $session = $this->request->session();
      if ($session->check('Auth.User')) { 
        echo $this->Html->link('Edit Nugget <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['action'=>'edit', $nugget->id], ['class'=>'btn btn-info', 'escape'=>false]);
      }
    ?>
  </div>
</div>

<h2><?= h($nugget->title) ?></h2>
<div class="row">
  <div class="col-md-5">
    
    <dl class="dl-horizontal">
      <dt><?= __('Start Date') ?></dt>
      <dd><?= h($nugget->start_date) ?></dd>
      <dt><?= __('End Date') ?></dt>
      <dd><?= h($nugget->end_date) ?></dd>
      <dt><?= __('Science Theme') ?></dt>
      <dd><?= h($nugget->science_theme) ?></dd>
      <dt><?= __('Science Concept') ?></dt>
      <dd><?= h($nugget->science_concept) ?></dd>
      <dt><?= __('Nextgen') ?></dt>
      <dd><?= h($nugget->nextgen) ?></dd>
      <dt><?= __('Difficulty') ?></dt>
      <dd><?= h($nugget->difficulty) ?></dd>
      <dt><?= __('Status') ?></dt>
      <dd><?php echo $this->element('instrument_status', ['status'=>$nugget->status]); ?></dd>
    </dl>

  </div>
  <div class="col-md-7">

    <dl class="dl-horizontal">
      <dt><?= __('Location') ?></dt>
      <dd><?= h($nugget->location) ?></dd>
      <dt><?= __('Graph Link') ?></dt>
      <dd><?php if($nugget->graph_link) { echo $this->Html->link('Graph <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>', $nugget->graph_link, ['class'=>'', 'escape'=>false]); } ?></dd>
      <dt><?= __('Notebook Link') ?></dt>
      <dd><?php if($nugget->notebook_link) { echo $this->Html->link('Notebook <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>', $nugget->notebook_link, ['class'=>'', 'escape'=>false]); } ?></dd>
      <dt><?= __('Data Link') ?></dt>
      <dd><?php if($nugget->data_link) { echo $this->Html->link('Data <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>', $nugget->data_link, ['class'=>'', 'escape'=>false]); } ?></dd>
    </dl>

  </div>
</div>


<div class="row">
  <div class="col-md-5">
    <h4><?= __('Instruments') ?></h4>
    <?php
       $txt = preg_replace( "/(.{8}-.{5}-.{12})/i", "<a href=\"/instruments/view/\\0\">\\0</a>", $nugget->instruments);
       echo $this->Text->autoParagraph($txt); 
    ?>
  </div>
  <div class="col-md-7">
    <h4><?= __('Description') ?></h4>
    <?php
       $txt = preg_replace( "/(.{8}-.{5}-.{12})/i", "<a href=\"/instruments/view/\\0\">\\0</a>", $nugget->description);
       echo $this->Text->autoParagraph($txt); 
    ?>
  </div>
</div>

<p><em>Last Modified: <?= h($nugget->modified) ?></em></p>
