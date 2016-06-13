<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asset Entity.
 *
 * @property int $id
 * @property string $ooi_barcode
 * @property string $description_of_equipment
 * @property float $quant
 * @property string $manufacturer
 * @property string $model
 * @property string $manufacturer_serial_no
 * @property string $firmware_version
 * @property string $source_of_the_equipment
 * @property string $whether_title
 * @property string $location
 * @property string $room_number
 * @property string $condition
 * @property string $acquisition_date
 * @property string $original_cost
 * @property string $federal_participation
 * @property string $comments
 * @property string $primary_tag_date
 * @property string $primary_tag_organization
 * @property string $primary_institute_asset_tag
 * @property string $secondary_tag_date
 * @property string $second_tag_organization
 * @property string $institute_asset_tag
 * @property string $doi_tag_date
 * @property string $doi_tag_organization
 * @property string $doi_institute_asset_tag
 */
class Asset extends Entity
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
        'id' => false,
    ];
}
