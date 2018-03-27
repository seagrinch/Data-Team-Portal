<?php
use Migrations\AbstractMigration;

class UpdateCruiseReviews2 extends AbstractMigration
{

    public function up()
    {

        $this->table('cruise_reviews')
            ->removeColumn('shipboard_data')
            ->removeColumn('water_sampling_data')
            ->update();

        $this->table('cruise_reviews')
            ->addColumn('ctd_rosette', 'date', [
                'after' => 'cruise_photos',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('ctd_log_sheets', 'date', [
                'after' => 'ctd_rosette',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('cruise_reviews')
            ->addColumn('shipboard_data', 'date', [
                'after' => 'cruise_photos',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data', 'date', [
                'after' => 'shipboard_data',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('ctd_rosette')
            ->removeColumn('ctd_log_sheets')
            ->update();
    }
}

