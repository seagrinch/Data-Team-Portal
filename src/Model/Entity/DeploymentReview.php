<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DeploymentReview Entity
 *
 * @property int $id
 * @property string $reference_designator
 * @property int $deployment
 * @property int $user_id
 * @property string $status
 * @property \Cake\I18n\Time $asset_sheet_reviewed
 * @property \Cake\I18n\Time $calibration_sheet_reviewed
 * @property \Cake\I18n\Time $deployment_sheet_reviewed
 * @property \Cake\I18n\Time $ingest_sheet_reviewed
 * @property \Cake\I18n\Time $raw_data_reviewed
 * @property string $raw_data_url
 * @property \Cake\I18n\Time $parameter_check
 * @property \Cake\I18n\Time $availability_check
 * @property \Cake\I18n\Time $quality_check
 * @property \Cake\I18n\Time $environment_check
 * @property float $percent_good
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 */
class DeploymentReview extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
