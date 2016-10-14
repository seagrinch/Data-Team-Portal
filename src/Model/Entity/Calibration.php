<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Calibration Entity
 *
 * @property int $id
 * @property string $class
 * @property string $asset_uid
 * @property \Cake\I18n\Time $start_date
 * @property string $serial
 * @property string $name
 * @property string $value
 * @property string $notes
 */
class Calibration extends Entity
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
