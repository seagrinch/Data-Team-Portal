<?php
use Migrations\AbstractMigration;

class AddCruiseWaterSamples extends AbstractMigration
{

    public function up()
    {

        $this->table('cruise_reviews')
            ->addColumn('recovered_data_ingested', 'date', [
                'after' => 'live_ingestion_started',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_carbon', 'date', [
                'after' => 'water_sampling_data',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_chl', 'date', [
                'after' => 'water_sampling_data_carbon',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_nutrients', 'date', [
                'after' => 'water_sampling_data_chl',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_salt', 'date', [
                'after' => 'water_sampling_data_nutrients',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('water_sampling_data_oxygen', 'date', [
                'after' => 'water_sampling_data_salt',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('cruise_reviews')
            ->removeColumn('recovered_data_ingested')
            ->removeColumn('water_sampling_data_carbon')
            ->removeColumn('water_sampling_data_chl')
            ->removeColumn('water_sampling_data_nutrients')
            ->removeColumn('water_sampling_data_salt')
            ->removeColumn('water_sampling_data_oxygen')
            ->update();
    }
}

