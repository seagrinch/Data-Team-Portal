<?php
use Migrations\AbstractMigration;

class UpdateBulkLoad extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->dropTable('assets');

        $this->dropTable('calibrations');

        $this->dropTable('deployments');

        $this->table('assets')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('asset_uid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('mobile', 'integer', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('description_of_equipment', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('manufacturer', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('model', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('manufacturer_serial_no', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('firmware_version', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('acquisition_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('original_cost', 'decimal', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('comments', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('calibrations')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('class', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('asset_uid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('start_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('serial', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 75,
                'null' => true,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('cruises')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('cuid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('ship_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('cruise_start_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cruise_end_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('deployments')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('deploy_cuid', 'string', [
                'default' => '',
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('deployed_by', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('recover_cuid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('recovered_by', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('deployment_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('version_number', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('start_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('stop_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('mooring_uid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('node_uid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('sensor_uid', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('latitude', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('longitude', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('orbit', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('deployment_depth', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('water_depth', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

    }

    public function down()
    {

        $this->dropTable('assets');

        $this->dropTable('calibrations');

        $this->dropTable('cruises');

        $this->dropTable('deployments');

        $this->table('assets')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('ooi_barcode', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('description_of_equipment', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('quant', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('manufacturer', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('model', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('manufacturer_serial_no', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('firmware_version', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('source_of_the_equipment', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('whether_title', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('location', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('room_number', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('condition', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('acquisition_date', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('original_cost', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('federal_participation', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('comments', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('primary_tag_date', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('primary_tag_organization', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('primary_institute_asset_tag', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('secondary_tag_date', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('second_tag_organization', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('institute_asset_tag', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('doi_tag_date', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('doi_tag_organization', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('doi_institute_asset_tag', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ooi_barcode',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('calibrations')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('mooring_barcode', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('mooring_serial_number', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('deployment_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sensor_barcode', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('sensor_serial_number', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('cc_name', 'string', [
                'default' => null,
                'limit' => 75,
                'null' => true,
            ])
            ->addColumn('cc_value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('deployments')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('mooring_barcode', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('mooring_serial_number', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('deployment_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('anchor_launch_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('anchor_launch_time', 'time', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('recover_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('latitude', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('longitude', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('water_depth', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cruise_number', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

    }
}

