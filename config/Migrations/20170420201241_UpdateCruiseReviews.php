<?php
use Migrations\AbstractMigration;

class UpdateCruiseReviews extends AbstractMigration
{

    public function up()
    {

        $this->table('cruise_reviews')
            ->removeColumn('cruise_plan_url')
            ->removeColumn('quick_look_url')
            ->removeColumn('ingest_sheet_reviewed')
            ->removeColumn('raw_data')
            ->removeColumn('raw_data_url')
            ->removeColumn('cruise_report_url')
            ->removeColumn('cruise_photos_url')
            ->removeColumn('shipboard_data_url')
            ->removeColumn('water_sampling_data_url')
            ->update();

        $this->table('cruise_reviews')
            ->addColumn('cruise_sheet_submitted', 'date', [
                'after' => 'deployment_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('cruise_sheet_reviewed', 'date', [
                'after' => 'cruise_sheet_submitted',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data_telemetered', 'date', [
                'after' => 'quick_look',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data_recovered', 'date', [
                'after' => 'raw_data_telemetered',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('ingest_sheet_telemetered', 'date', [
                'after' => 'raw_data_recovered',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('ingest_sheet_recovered', 'date', [
                'after' => 'ingest_sheet_telemetered',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('cruise_reviews')
            ->addColumn('cruise_plan_url', 'string', [
                'after' => 'cruise_plan',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('quick_look_url', 'string', [
                'after' => 'quick_look',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('ingest_sheet_reviewed', 'date', [
                'after' => 'deployment_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data', 'date', [
                'after' => 'ingest_sheet_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('raw_data_url', 'string', [
                'after' => 'raw_data',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('cruise_report_url', 'string', [
                'after' => 'cruise_report',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('cruise_photos_url', 'string', [
                'after' => 'cruise_photos',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('shipboard_data_url', 'string', [
                'after' => 'shipboard_data',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_url', 'string', [
                'after' => 'water_sampling_data',
                'default' => null,
                'length' => 1028,
                'null' => true,
            ])
            ->removeColumn('cruise_sheet_submitted')
            ->removeColumn('cruise_sheet_reviewed')
            ->removeColumn('raw_data_telemetered')
            ->removeColumn('raw_data_recovered')
            ->removeColumn('ingest_sheet_telemetered')
            ->removeColumn('ingest_sheet_recovered')
            ->update();
    }
}

