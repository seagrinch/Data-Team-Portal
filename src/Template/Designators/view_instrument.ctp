<h3><?= $this->html->link($platform->parent->name,['action'=>'view',$platform->parent->reference_designator]) ?> / 
<?= $this->html->link($platform->name,['action'=>'view',$platform->reference_designator]) ?> / 
<?= $this->html->link($designator->parent->name,['action'=>'view',$designator->parent->reference_designator]) ?></h3>

<h3><?= h($designator->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($designator->reference_designator) ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($designator->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($designator->longitude) ?></dd>
  <dt><?= __('Start Depth') ?></dt>
  <dd><?= $this->Number->format($designator->start_depth) ?></dd>
  <dt><?= __('End Depth') ?></dt>
  <dd><?= $this->Number->format($designator->end_depth) ?></dd>
</dl>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#streams" aria-controls="home" role="tab" data-toggle="tab">Streams</a></li>
    <li role="presentation"><a href="#deployments" aria-controls="profile" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation"><a href="#calibrations" aria-controls="profile" role="tab" data-toggle="tab">Deployments</a></li>
    <li role="presentation" class="active"><a href="#instrument" aria-controls="messages" role="tab" data-toggle="tab">Instrument Info</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="streams">...</div>
    <div role="tabpanel" class="tab-pane" id="deployments">...</div>
    <div role="tabpanel" class="tab-pane" id="calibrations">...</div>
    <div role="tabpanel" class="tab-pane active" id="instrument">
      <dl class="dl-horizontal">
        <dt><?= __('Class') ?></dt>
        <dd><?= h($instrument_class->class) ?></dd>
        <dt><?= __('Name') ?></dt>
        <dd><?= h($instrument_class->name) ?></dd>
        <dt><?= __('Description') ?></dt>
        <dd><?= h($instrument_class->description) ?></dd>
        <dt><?= __('Primary Science Dicipline') ?></dt>
        <dd><?= h($instrument_class->primary_science_dicipline) ?></dd>

        <dt><?= __('Series') ?></dt>
        <dd><?= h($instrument_model->series) ?></dd>
        <dt><?= __('Manufacturer') ?></dt>
        <dd><?= h($instrument_model->manufacturer) ?></dd>
        <dt><?= __('Model') ?></dt>
        <dd><?= h($instrument_model->model) ?></dd>
      </dl>      
    </div>
  </div>

</div>


<?php 
/*
  use Cake\Error\Debugger;
  Debugger::dump($platform);
*/
?>
