<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Nuggets'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($nugget->title) ?></li>
</ol>

<div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
  <div class="btn-group btn-group-sm" role="group" aria-label="...">
    <?php 
      $session = $this->request->session();
      if ($session->check('Auth.User')) { 
        echo $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Nugget', ['action'=>'edit', $nugget->id], ['class'=>'btn btn-info', 'escape'=>false]);
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
      <dd><?= h($nugget->graph_link) ?></dd>
      <dt><?= __('Notebook Link') ?></dt>
      <dd><?= h($nugget->notebook_link) ?></dd>
      <dt><?= __('Data Link') ?></dt>
      <dd><?= h($nugget->data_link) ?></dd>
    </dl>

  </div>
</div>


<div class="row">
  <div class="col-md-5">
    <h4><?= __('Instruments') ?></h4>
    <?= $this->Text->autoParagraph(h($nugget->instruments)); ?>
  </div>
  <div class="col-md-7">
    <h4><?= __('Description') ?></h4>
    <?= $this->Text->autoParagraph(h($nugget->description)); ?>
  </div>
</div>

<p><em>Last Modified: <?= h($nugget->modified) ?></em></p>
