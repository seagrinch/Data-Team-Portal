<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Cruises'), ['controller'=>'cruises', 'action' => 'index']) ?></li>
  <li><?= $this->Html->link($cruiseReview->cruise_cuid, ['controller'=>'cruises', 'action' => 'view', $cruiseReview->cruise_cuid]) ?></li>
  <li>Review</li>
</ol>

<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Review', ['action'=>'edit', $cruiseReview->cruise_cuid], ['class'=>'btn btn-info']);
    }
  ?>
</div>

<h2>Cruise Review for <?= h($cruiseReview->cruise_cuid) ?></h2>

<div class="row">
  <div class="col-md-6">

<?php if ($cruiseReview->has('cruise')): ?>
<dl class="dl-horizontal">
  <dt><?= __('Ship Name') ?></dt>
  <dd><?= h($cruiseReview->cruise->ship_name) ?></dd>
  <dt><?= __('Cruise Start Date') ?></dt>
  <dd><?= h($cruiseReview->cruise->cruise_start_date) ?></dd>
  <dt><?= __('Cruise End Date') ?></dt>
  <dd><?= h($cruiseReview->cruise->cruise_end_date) ?></dd>
  <dt><?= __('Notes') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($cruiseReview->cruise->notes)) ?></dd>
</dl>
<?php endif; ?>

  </div>
  <div class="col-md-6">

<dl class="dl-horizontal">
  <dt><?= __('Reviewer') ?></dt>
  <dd><?= $cruiseReview->has('user') ? $this->Html->link($cruiseReview->user->username, ['controller' => 'Users', 'action' => 'view', $cruiseReview->user->id]) : '' ?></dd>
  <dt><?= __('Review Status') ?></dt>
  <dd><?= h($cruiseReview->status) ?></dd>
  <dt><?= __('Modified') ?></dt>
  <dd><?= $this->Time->timeAgoInWords($cruiseReview->modified) ?></dd>
</dl>

  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <h3>Cruise Information</h3>
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Item</th>
          <th>MIO Submission Date</th>
          <th>Data Team Review Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><?= __('Cruise Plan') ?></th>
          <td><?= h($cruiseReview->cruise_plan) ?></td>
          <td>n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Bulk Load Sheets') ?></th>
          <td><?= h($cruiseReview->asset_sheet_submitted) ?></td>
          <td><?= h($cruiseReview->asset_sheet_reviewed) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Calibration Sheets') ?></th>
          <td><?= h($cruiseReview->calibration_sheet_submitted) ?></td>
          <td><?= h($cruiseReview->calibration_sheet_reviewed) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Deployment Sheets') ?></th>
          <td><?= h($cruiseReview->deployment_sheet_submitted) ?></td>
          <td><?= h($cruiseReview->deployment_sheet_reviewed) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Cruise Info Sheet') ?></th>
          <td><?= h($cruiseReview->cruise_sheet_submitted) ?></td>
          <td><?= h($cruiseReview->cruise_sheet_reviewed) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Quick Look Report') ?></th>
          <td><?= h($cruiseReview->quick_look) ?></td>
          <td>n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Cruise Report') ?></th>
          <td><?= h($cruiseReview->cruise_report) ?></td>
          <td>n/a</td>
        </tr>
        <tr>
          <th scope="row"><?= __('Cruise Photos') ?></th>
          <td><?= h($cruiseReview->cruise_photos) ?></td>
          <td>n/a</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <h3>Data Ingestion</h3>
    <table class="table table-striped table-hover table-condensed">
      <tbody>
        <tr>
          <th scope="row"><?= __('Raw Data (telemetered/streamed)') ?></th>
          <td><?= h($cruiseReview->raw_data_telemetered) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Raw Data (recovered)') ?></th>
          <td><?= h($cruiseReview->raw_data_recovered) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Ingest Sheets (telemetered/streamed)') ?></th>
          <td><?= h($cruiseReview->ingest_sheet_telemetered) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Ingest Sheets (recovered)') ?></th>
          <td><?= h($cruiseReview->ingest_sheet_recovered) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Live Ingestion Started') ?></th>
          <td><?= h($cruiseReview->live_ingestion_started) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Recovered Data Ingested') ?></th>
          <td><?= h($cruiseReview->recovered_data_ingested) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <h3>Cruise Data</h3>
    <table class="table table-striped table-hover table-condensed">
      <tbody>
        <tr>
          <th scope="row"><?= __('Shipboard Data') ?></th>
          <td><?= h($cruiseReview->shipboard_data) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data') ?></th>
          <td><?= h($cruiseReview->water_sampling_data) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Carbon') ?></th>
          <td><?= h($cruiseReview->water_sampling_data_carbon) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Chl') ?></th>
          <td><?= h($cruiseReview->water_sampling_data_chl) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Nutrients') ?></th>
          <td><?= h($cruiseReview->water_sampling_data_nutrients) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Salt') ?></th>
          <td><?= h($cruiseReview->water_sampling_data_salt) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Water Sampling Data - Oxygen') ?></th>
          <td><?= h($cruiseReview->water_sampling_data_oxygen) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div class="row">
  <div class="col-md-6">
    <h4><?= __('Cruise Review Summary') ?></h4>
    <?php 
      if ($cruiseReview->summary) {
        //echo $this->Text->autoParagraph(h($cruiseReview->summary));
        $parser = new \Netcarver\Textile\Parser();
        echo $parser->textileThis($cruiseReview->summary);
      } else {
        echo 'None';
      } 
    ?>
  </div>
  <div class="col-md-6">
    <h4><?= __('Data Team Notes') ?></h4>
    <?php 
      if ($cruiseReview->notes) {
        //echo $this->Text->autoParagraph(h($cruiseReview->notes)); 
        $parser = new \Netcarver\Textile\Parser();
        echo $parser->textileThis($cruiseReview->notes);
      } else {
        echo 'None';  
      }
    ?>
  </div>
</div>
