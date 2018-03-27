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
    <?= $this->Form->input('status',['options'=>[
      'Not Started'=>'Not Started',
      'In Progress'=>'In Progress',
      'Blocked'=>'Blocked',
      'Complete'=>'Complete'
      ]]) ?>
  </div>
  <div class="col-md-4">
      <?= $this->Form->input('user_id', ['options' => $users, 'empty' => true, 'label'=>'Reviewer']); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <h3>Cruise Information</h3>
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Item</th>
          <th>MIO Submitted</th>
          <th>Date Team Reviewed</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><?= __('Cruise Plan') ?></th>
          <td><?= $this->Form->input('cruise_plan', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td class="text-center">n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Bulk Load Sheets') ?></th>
          <td><?= $this->Form->input('asset_sheet_submitted', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td><?= $this->Form->input('asset_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Deployment Sheets') ?></th>
          <td><?= $this->Form->input('deployment_sheet_submitted', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td><?= $this->Form->input('deployment_sheet_reviewed', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Quick Look Report') ?></th>
          <td><?= $this->Form->input('quick_look', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td class="text-center">n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Cruise Report') ?></th>
          <td><?= $this->Form->input('cruise_report', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td class="text-center">n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Cruise Photos') ?></th>
          <td><?= $this->Form->input('cruise_photos', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
          <td class="text-center">n/a</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <h3>Cruise Data</h3>
    <table class="table table-striped table-condensed">
      <tbody>
        <tr>
          <th scope="row"><?= __('CTD Rosette Data') ?></th>
          <td><?= $this->Form->input('ctd_rosette', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('CTD Log Sheets') ?></th>
          <td><?= $this->Form->input('ctd_log_sheets', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Carbon') ?></th>
          <td><?= $this->Form->input('water_sampling_data_carbon', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Chl') ?></th>
          <td><?= $this->Form->input('water_sampling_data_chl', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Nutrients') ?></th>
          <td><?= $this->Form->input('water_sampling_data_nutrients', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Salt') ?></th>
          <td><?= $this->Form->input('water_sampling_data_salt', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Oxygen') ?></th>
          <td><?= $this->Form->input('water_sampling_data_oxygen', ['type'=>'text', 'empty' => true, 'label'=>false]) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <h4><?= __('Cruise Review Summary') ?></h4>
    <?= $this->Form->input('summary', ['label'=>false, 'rows'=>'10','help'=>'This field accepts <a href="https://txstyle.org">Textile markup</a>']); ?>
  </div>
  <div class="col-md-6">
    <h4><?= __('Data Team Notes') ?></h4>
    <?= $this->Form->input('notes', ['label'=>false, 'rows'=>'10','help'=>'This field accepts <a href="https://txstyle.org">Textile markup</a>']); ?>
  </div>
</div>
  
<?= $this->Html->link('Cancel', ['action' => 'view', $cruiseReview->cruise_cuid], ['class'=>'btn btn-default']); ?> 
<?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>
