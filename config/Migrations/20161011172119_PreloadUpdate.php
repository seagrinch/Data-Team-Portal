<?php
use Migrations\AbstractMigration;

class PreloadUpdate extends AbstractMigration
{

    public function up()
    {

        $this->table('streams')
            ->removeColumn('uses_ctd')
            ->update();

    }

    public function down()
    {

        $this->table('streams')
            ->addColumn('uses_ctd', 'boolean', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }
}

