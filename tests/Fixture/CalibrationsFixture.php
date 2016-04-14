<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CalibrationsFixture
 *
 */
class CalibrationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'reference_designator' => ['type' => 'string', 'length' => 27, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'mooring_barcode' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'mooring_serial_number' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'deployment_number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sensor_barcode' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'sensor_serial_number' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cc_name' => ['type' => 'string', 'length' => 75, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cc_value' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'reference_designator' => 'Lorem ipsum dolor sit ame',
            'mooring_barcode' => 'Lorem ipsum dolor sit a',
            'mooring_serial_number' => 'Lorem ipsum dolor sit a',
            'deployment_number' => 1,
            'sensor_barcode' => 'Lorem ipsum dolor sit a',
            'sensor_serial_number' => 'Lorem ipsum dolor sit a',
            'cc_name' => 'Lorem ipsum dolor sit amet',
            'cc_value' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
