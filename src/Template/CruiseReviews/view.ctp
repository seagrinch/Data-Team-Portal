<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruise Reviews'), ['controller'=>'cruise_reviews', 'action' => 'index']) ?></li>
  <li><?= h($cruiseReview->cruise_cuid); ?></li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Review', ['action'=>'edit', $cruiseReview->cruise_cuid], ['class'=>'btn btn-info']);
    }
  ?>
</div>

<h2>Cruise: <?= h($cruiseReview->cruise_cuid) ?></h2>

<dl class="dl-horizontal">
  <dt><?= __('Ship Name') ?></dt>
  <dd><?= h($cruiseReview->cruise->ship_name) ?></dd>
  <dt><?= __('Cruise Start Date') ?></dt>
  <dd><?= h($cruiseReview->cruise->cruise_start_date) ?></dd>
  <dt><?= __('Cruise End Date') ?></dt>
  <dd><?= h($cruiseReview->cruise->cruise_end_date) ?></dd>
  <dt><?= __('Notes') ?></dt>
  <dd><?= h($cruiseReview->cruise->notes) ?></dd>
  <dt><?= __('Review Status') ?></dt>
  <dd><?= h($cruiseReview->status) ?></dd>
</dl>

<table class="table table-striped">
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
      <td><?= h($cruiseReview->cruise_plan) ?></td>
      <td>&mdash;</td>
      <td><?= h($cruiseReview->cruise_plan_url) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Quick Look') ?></th>
        <td><?= h($cruiseReview->quick_look) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->quick_look_url) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Asset Sheet') ?></th>
        <td><?= h($cruiseReview->asset_sheet_submitted) ?></td>
        <td><?= h($cruiseReview->asset_sheet_reviewed) ?></td>
        <td>&mdash;</td>
    </tr>
    <tr>
        <th scope="row"><?= __('Calibration Sheet') ?></th>
        <td><?= h($cruiseReview->calibration_sheet_submitted) ?></td>
        <td><?= h($cruiseReview->calibration_sheet_reviewed) ?></td>
        <td>&mdash;</td>
    </tr>
    <tr>
        <th scope="row"><?= __('Deployment Sheet') ?></th>
        <td><?= h($cruiseReview->deployment_sheet_submitted) ?></td>
        <td><?= h($cruiseReview->deployment_sheet_reviewed) ?></td>
        <td>&mdash;</td>
    </tr>
    <tr>
        <th scope="row"><?= __('Ingest Sheet') ?></th>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->ingest_sheet_reviewed) ?></td>
        <td>&mdash;</td>
    </tr>
    <tr>
        <th scope="row"><?= __('Raw Data') ?></th>
            <td><?= h($cruiseReview->raw_data) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->raw_data_url) ?></td>
    </tr>
        <tr>
        <th scope="row"><?= __('Live Ingestion Started') ?></th>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->live_ingestion_started) ?></td>
        <td>&mdash;</td>
    </tr>
    <tr>
        <th scope="row"><?= __('Cruise Report') ?></th>
        <td><?= h($cruiseReview->cruise_report) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->cruise_report_url) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Cruise Photos') ?></th>
        <td><?= h($cruiseReview->cruise_photos) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->cruise_photos_url) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Shipboard Data') ?></th>
        <td><?= h($cruiseReview->shipboard_data) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->shipboard_data_url) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Water Sampling Data') ?></th>
        <td><?= h($cruiseReview->water_sampling_data) ?></td>
        <td>&mdash;</td>
        <td><?= h($cruiseReview->water_sampling_data_url) ?></td>
    </tr>
    </table>
    <div class="row">
        <h4><?= __('Summary') ?></h4>
        <?= $this->Text->autoParagraph(h($cruiseReview->summary)); ?>
    </div>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($cruiseReview->notes)); ?>
    </div>
</div>
