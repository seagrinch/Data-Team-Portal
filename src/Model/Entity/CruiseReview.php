<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CruiseReview Entity
 *
 * @property int $id
 * @property string $cruise_cuid
 * @property string $status
 * @property \Cake\I18n\Time $cruise_plan
 * @property string $cruise_plan_url
 * @property \Cake\I18n\Time $quick_look
 * @property string $quick_look_url
 * @property \Cake\I18n\Time $asset_sheet_submitted
 * @property \Cake\I18n\Time $asset_sheet_reviewed
 * @property \Cake\I18n\Time $calibration_sheet_submitted
 * @property \Cake\I18n\Time $calibration_sheet_reviewed
 * @property \Cake\I18n\Time $deployment_sheet_submitted
 * @property \Cake\I18n\Time $deployment_sheet_reviewed
 * @property \Cake\I18n\Time $ingest_sheet_reviewed
 * @property \Cake\I18n\Time $raw_data
 * @property string $raw_data_url
 * @property \Cake\I18n\Time $live_ingestion_started
 * @property \Cake\I18n\Time $cruise_report
 * @property string $cruise_report_url
 * @property \Cake\I18n\Time $cruise_photos
 * @property string $cruise_photos_url
 * @property \Cake\I18n\Time $shipboard_data
 * @property string $shipboard_data_url
 * @property \Cake\I18n\Time $water_sampling_data
 * @property string $water_sampling_data_url
 * @property string $summary
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CruiseReview extends Entity
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
