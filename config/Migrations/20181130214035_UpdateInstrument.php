<?php
use Migrations\AbstractMigration;

class UpdateInstrument extends AbstractMigration
{

    public function up()
    {

        $this->table('instruments')
            ->addColumn('note', 'text', [
                'after' => 'last_reviewed',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('instruments')
            ->removeColumn('note')
            ->update();
    }
}

