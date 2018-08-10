<?php
use Migrations\AbstractMigration;

class UpdateDeploymentReview extends AbstractMigration
{

    public function up()
    {

        $this->table('deployment_reviews')
            ->removeColumn('asset_sheet_reviewed')
            ->removeColumn('calibration_sheet_reviewed')
            ->removeColumn('deployment_sheet_reviewed')
            ->removeColumn('ingest_sheet_reviewed')
            ->removeColumn('raw_data_reviewed')
            ->removeColumn('raw_data_url')
            ->removeColumn('parameter_check')
            ->removeColumn('availability_check')
            ->removeColumn('quality_check')
            ->removeColumn('environment_check')
            ->removeColumn('percent_good')
            ->changeColumn('status', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->update();

        $this->table('deployment_reviews')
            ->addColumn('available_streams', 'string', [
                'after' => 'status',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('cruise_data_check', 'string', [
                'after' => 'available_streams',
                'default' => null,
                'length' => 20,
                'null' => true,
            ])
            ->addColumn('completed_date', 'date', [
                'after' => 'cruise_data_check',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

    }

    public function down()
    {

        $this->table('deployment_reviews')
            ->addColumn('asset_sheet_reviewed', 'date', [
                'after' => 'status',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('calibration_sheet_reviewed', 'date', [
                'after' => 'asset_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('deployment_sheet_reviewed', 'date', [
                'after' => 'calibration_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('ingest_sheet_reviewed', 'date', [
                'after' => 'deployment_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data_reviewed', 'date', [
                'after' => 'ingest_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data_url', 'string', [
                'after' => 'raw_data_reviewed',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('parameter_check', 'date', [
                'after' => 'raw_data_url',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('availability_check', 'date', [
                'after' => 'parameter_check',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('quality_check', 'date', [
                'after' => 'availability_check',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('environment_check', 'date', [
                'after' => 'quality_check',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('percent_good', 'decimal', [
                'after' => 'environment_check',
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 2,
            ])
            ->changeColumn('status', 'string', [
                'default' => null,
                'length' => 15,
                'null' => true,
            ])
            ->removeColumn('available_streams')
            ->removeColumn('cruise_data_check')
            ->removeColumn('completed_date')
            ->update();

    }
}

