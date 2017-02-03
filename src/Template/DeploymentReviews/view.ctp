<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Deployment Reviews'), ['controller'=>'deployment_reviews', 'action' => 'index']) ?></li>
  <li><?= h($deploymentReview->reference_designator); ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></li>
</ol>


<div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
  <?php 
    $session = $this->request->session();
    if ($session->check('Auth.User')) { 
      echo $this->Html->link('Edit Review', ['action'=>'edit', $deploymentReview->reference_designator, $deploymentReview->deployment_number], ['class'=>'btn btn-info']);
    }
  ?>
</div>

<h2><?= h($deploymentReview->reference_designator); ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></h2>

<dl class="dl-horizontal">
  <dt><?= __('Reviewer') ?></th></dt>
  <dd><?= $deploymentReview->has('user') ? $this->Html->link($deploymentReview->user->username, ['controller' => 'Users', 'action' => 'view', $deploymentReview->user->id]) : '' ?></dd>
  <dt><?= __('Review Status') ?></dt>
  <dd><?= h($deploymentReview->status) ?></dd>
  <dt><?= __('Asset Sheet Reviewed') ?></dt>
  <dd><?= h($deploymentReview->asset_sheet_reviewed) ?></dd>
  <dt><?= __('Calibration Sheet Reviewed') ?></dt>
  <dd><?= h($deploymentReview->calibration_sheet_reviewed) ?></dd>
  <dt><?= __('Deployment Sheet Reviewed') ?></dt>
  <dd><?= h($deploymentReview->deployment_sheet_reviewed) ?></dd>
  <dt><?= __('Ingest Sheet Reviewed') ?></dt>
  <dd><?= h($deploymentReview->ingest_sheet_reviewed) ?></dd>
  <dt><?= __('Raw Data Reviewed') ?></dt>
  <dd><?= h($deploymentReview->raw_data_reviewed) ?></dd>
  <dt><?= __('Raw Data Url') ?></dt>
  <dd><?= h($deploymentReview->raw_data_url) ?></dd>
  <dt><?= __('Parameter Check') ?></dt>
  <dd><?= h($deploymentReview->parameter_check) ?></dd>
  <dt><?= __('Availability Check') ?></dt>
  <dd><?= h($deploymentReview->availability_check) ?></dd>
  <dt><?= __('Quality Check') ?></dt>
  <dd><?= h($deploymentReview->quality_check) ?></dd>
  <dt><?= __('Environment Check') ?></dt>
  <dd><?= h($deploymentReview->environment_check) ?></dd>
  <dt><?= __('Percent Good') ?></dt>
  <dd><?= $this->Number->format($deploymentReview->percent_good) ?></dd>
  <dt><?= __('Modified') ?></dt>
  <dd><?= $this->Time->timeAgoInWords($deploymentReview->modified) ?></dd>
</dl>

<div class="row">
    <h4><?= __('Notes') ?></h4>
    <?php 
      if ($deploymentReview->notes) {
        echo $this->Text->autoParagraph(h($deploymentReview->notes)); 
      } else {
        echo 'None';  
      }
    ?>
</div>

