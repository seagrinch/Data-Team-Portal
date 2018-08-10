<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Deployment Reviews'), ['controller'=>'deployment_reviews', 'action' => 'index']) ?></li>
  <li><?= $this->html->link($deploymentReview->reference_designator,['controller'=>'instruments','action'=>'view',$deploymentReview->reference_designator]) ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></li>
  <li class="active">Edit</li>
</ol>


<?= $this->Form->create($deploymentReview)?>
<fieldset>
  <legend>Edit Review for <?= h($deploymentReview->reference_designator); ?> &mdash; 
          Deployment <?= h($deploymentReview->deployment_number); ?></legend>
</fieldset>

<div class="row">
  <div class="col-md-2"><strong>Status</strong></div>
  <div class="col-md-4">  <?= $this->Form->input('status', ['type'=>'radio', 'options'=>[
    'Not Started'=>'Not Started',
    'In Progress'=>'In Progress',
    'Blocked'=>'Blocked',
    'Complete'=>'Complete'
    ], 'label'=>false, 'inline'=>false]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-2"><strong>Reviewer</strong></div>
  <div class="col-md-4">  <?= $this->Form->input('user_id', ['options' => $users, 'empty' => true, 'label'=>false, 'align'=>'horizontal']); ?></div>
</div>

<div class="row">
  <div class="col-md-2"><label for="cruise_data_check">Available Streams</label></div>
  <div class="col-md-4"><?= $this->Form->input('available_streams', ['type'=>'select', 'options' => [
    'Telemetered Only'=>'Telemetered Only',
    'Recovered Only'=>'Recovered Only',
    'Telemetered & Recovered'=>'Telemetered & Recovered',
    'Streamed Only'=>'Streamed Only'
    ], 'empty' => true, 'label'=>false]); ?></div>
</div>

<!--
<div class="row">
  <div class="col-md-2"><strong>Reviews</strong></div>
  <div class="col-md-10">  
    <table class="table table-condensed">
      <tr>
        <th></th>
        <th>Available</th>
        <th>Quality Check</th>
      </tr>
      <tr>
        <td width="20%"> Telemetered</td>
        <td width="40%">  <?//= $this->Form->input('telemetered_available', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'Pending'=>'Pending' ]]); ?>
    </td>
        <td width="40%">  <?//= $this->Form->input('telemetered_check', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'N/A'=>'N/A']]); ?>
    </td>
      </tr>
      <tr>
        <td>Recovered</td>
        <td>  <?//= $this->Form->input('recovered_available', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'Pending'=>'Pending']]); ?>
    </td>
        <td>  <?//= $this->Form->input('recovered_check', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'N/A'=>'N/A']]); ?>
    </td>
      </tr>
      <tr>
        <td>Streamed</td>
        <td>  <?//= $this->Form->input('streamed_available', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'Pending'=>'Pending']]); ?>
    </td>
        <td>  <?//= $this->Form->input('streamed_check', ['type'=>'radio', 'inline'=>true, 'label'=>false, 'options' => ['Yes'=>'Yes', 'No'=>'No', 'N/A'=>'N/A']]); ?>
    </td>
      </tr>
    </table>
  </div>
</div>
-->

<div class="row">
  <div class="col-md-2"><label for="cruise_data_check">Cruise Data Check</label></div>
  <div class="col-md-4"><?= $this->Form->input('cruise_data_check', ['type'=>'radio', 'options'=>[
    'Yes'=>'Yes',
    'No'=>'No',
    'Not Available'=>'Not Available'
    ], 'label'=>false, 'inline'=>true]); ?></div>
</div>

<div class="row">
  <div class="col-md-2"><strong>Completed Date</strong></div>
  <div class="col-md-4"><?= $this->Form->input('completed_date', ['type'=>'text', 'label'=>false, 'empty' => true]); ?></div>
</div>

<?= $this->Form->input('notes', ['label'=>'Review Notes', 'rows'=>'10','help'=>'This field accepts <a href="https://txstyle.org">Textile markup</a>']); ?>

<?= $this->Html->link('Cancel', ['action' => 'view', $deploymentReview->reference_designator, $deploymentReview->deployment_number], ['class'=>'btn btn-default']); ?> 
<?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>
