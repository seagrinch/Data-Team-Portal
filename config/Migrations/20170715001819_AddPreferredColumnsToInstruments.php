<?php
use Migrations\AbstractMigration;

class AddPreferredColumnsToInstruments extends AbstractMigration
{

    public function up()
    {

        $this->table('instruments')
            ->addColumn('preferred_stream', 'string', [
                'after' => 'current_status',
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->addColumn('preferred_parameter', 'string', [
                'after' => 'preferred_stream',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('instruments')
            ->removeColumn('preferred_stream')
            ->removeColumn('preferred_parameter')
            ->update();
    }
}

