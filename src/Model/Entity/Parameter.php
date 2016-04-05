<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parameter Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property string $fill_value
 * @property string $display_name
 * @property string $standard_name
 * @property string $precision
 * @property string $parameter_function_id
 * @property \App\Model\Entity\ParameterFunction $parameter_function
 * @property string $parameter_function_map
 * @property string $data_product_identifier
 * @property string $description
 * @property \App\Model\Entity\Stream[] $streams
 */
class Parameter extends Entity
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
