<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Deployment Entity
 *
 * @property int $id
 * @property string $deploy_cuid
 * @property string $deployed_by
 * @property string $recover_cuid
 * @property string $recovered_by
 * @property string $reference_designator
 * @property int $deployment_number
 * @property string $version_number
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $stop_date
 * @property string $mooring_uid
 * @property string $node_uid
 * @property string $sensor_uid
 * @property float $latitude
 * @property float $longitude
 * @property string $orbit
 * @property float $deployment_depth
 * @property float $water_depth
 * @property string $notes
 */
class Deployment extends Entity
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
