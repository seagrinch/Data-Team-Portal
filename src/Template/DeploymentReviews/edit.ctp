<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Deployment Reviews'), ['controller'=>'deployment_reviews', 'action' => 'index']) ?></li>
  <li><?= h($deploymentReview->reference_designator); ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></li>
  <li class="active">Edit</li>
</ol>


<?= $this->Form->create($deploymentReview, ['align' => [
    'sm' => [
        'left' => 6,
        'middle' => 6,
        'right' => 12
    ],
    'md' => [
        'left' => 4,
        'middle' => 4,
        'right' => 4
    ]
]]) ?>
<fieldset>
    <legend>Edit Review for <?= h($deploymentReview->reference_designator); ?> &mdash; Deployment <?= h($deploymentReview->deployment_number); ?></legend>
    <?php
        echo $this->Form->input('status',['options'=>['Not Started'=>'Not Started','Pending'=>'Pending','Complete'=>'Complete']]);
        echo $this->Form->input('asset_sheet_reviewed', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('calibration_sheet_reviewed', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('deployment_sheet_reviewed', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('ingest_sheet_reviewed', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('raw_data_reviewed', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('raw_data_url');
        echo $this->Form->input('parameter_check', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('availability_check', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('quality_check', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('environment_check', ['type'=>'text', 'empty' => true]);
        echo $this->Form->input('percent_good');
        echo $this->Form->input('notes');
    ?>
</fieldset>
<?= $this->Html->link('Cancel', ['action' => 'view', $deploymentReview->reference_designator, $deploymentReview->deployment_number], ['class'=>'btn btn-default']); ?> 
<?= $this->Form->button(__('Save Changes'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>
