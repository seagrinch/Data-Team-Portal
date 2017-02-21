<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruises'), ['controller'=>'cruises', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($cruiseReview->cruise_cuid, ['controller'=>'cruises', 'action' => 'view', $cruiseReview->cruise_cuid]) ?></li>
  <li><?= $this->Html->link('Review', ['controller'=>'cruise-reviews', 'action' => 'view', $cruiseReview->cruise_cuid]) ?></li>
  <li>Edit</li>
</ol>

<?= $this->Form->create($cruiseReview) ?>
<fieldset>
  <legend>Edit Review for Cruise: <?= h($cruiseReview->cruise_cuid) ?></legend>
</fieldset>

<div class="row">
  <div class="col-md-4">
    <?= $this->Form->input('status',['options'=>['Not Started'=>'Not Started','In Progress'=>'In Progress','Complete'=>'Complete']]) ?>
  </div>
  <div class="col-md-4">
      <?= $this->Form->input('user_id', ['options' => $users, 'empty' => true, 'label'=>'Reviewer']); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">

  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th>Item</th>
        <th>MIO Submitted</th>
        <th>Date Team Reviewed</th>
        <th>URL</tdh>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?= __('Cruise Plan') ?></th>
        <td><?= $this->Form->input('cruise_plan', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        <td>n/a</td>
        <td><?= $this->Form->input('cruise_plan_url',['label'=>false]) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Quick Look') ?></th>
          <td><?= $this->Form->input('quick_look', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('quick_look_url',['label'=>false]) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Asset Sheet') ?></th>
          <td><?= $this->Form->input('asset_sheet_submitted', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td><?= $this->Form->input('asset_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
      </tr>
      <tr>
          <th scope="row"><?= __('Calibration Sheet') ?></th>
          <td><?= $this->Form->input('calibration_sheet_submitted', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td><?= $this->Form->input('calibration_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
      </tr>
      <tr>
          <th scope="row"><?= __('Deployment Sheet') ?></th>
          <td><?= $this->Form->input('deployment_sheet_submitted', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td><?= $this->Form->input('deployment_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
      </tr>
      <tr>
          <th scope="row"><?= __('Ingest Sheet') ?></th>
          <td>n/a</td>
          <td><?= $this->Form->input('ingest_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
      </tr>
      <tr>
          <th scope="row"><?= __('Raw Data') ?></th>
              <td><?= $this->Form->input('raw_data', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('raw_data_url',['label'=>false]) ?></td>
      </tr>
          <tr>
          <th scope="row"><?= __('Live Ingestion Started') ?></th>
          <td>n/a</td>
          <td><?= $this->Form->input('live_ingestion_started', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
      </tr>
      <tr>
          <th scope="row"><?= __('Cruise Report') ?></th>
          <td><?= $this->Form->input('cruise_report', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('cruise_report_url',['label'=>false]) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Cruise Photos') ?></th>
          <td><?= $this->Form->input('cruise_photos', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('cruise_photos_url',['label'=>false]) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Shipboard Data') ?></th>
          <td><?= $this->Form->input('shipboard_data', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('shipboard_data_url',['label'=>false]) ?></td>
      </tr>
      <tr>
          <th scope="row"><?= __('Water Sampling Data') ?></th>
          <td><?= $this->Form->input('water_sampling_data', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td>n/a</td>
          <td><?= $this->Form->input('water_sampling_data_url',['label'=>false]) ?></td>
      </tr>
      </table>
      <div class="row">
          <h4><?= __('Summary') ?></h4>
          <?= $this->Form->input('summary', ['label'=>false]); ?>
      </div>
      <div class="row">
          <h4><?= __('Notes') ?></h4>
          <?= $this->Form->input('notes', ['label'=>false]); ?>
      </div>
  </div>
  
<?= $this->Html->link('Cancel', ['action' => 'view', $cruiseReview->cruise_cuid], ['class'=>'btn btn-default']); ?> 
<?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>

  </div>
<div>
