<?php
use Migrations\AbstractMigration;

class AddWebsiteInfoToInstruments extends AbstractMigration
{

    public function up()
    {

        $this->table('instrument_classes')
            ->addColumn('website_info', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
                'after' => 'description',
            ])
            ->update();

        $this->table('instrument_models')
            ->addColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
                'after' => 'model',
            ])
            ->addColumn('website_info', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
                'after' => 'description',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('instrument_classes')
            ->removeColumn('website_info')
            ->update();

        $this->table('instrument_models')
            ->removeColumn('description')
            ->removeColumn('website_info')
            ->update();
    }
}

