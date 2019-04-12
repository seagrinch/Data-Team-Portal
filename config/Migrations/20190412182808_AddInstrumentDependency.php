<?php
use Migrations\AbstractMigration;

class AddInstrumentDependency extends AbstractMigration
{

    public function up()
    {

        $this->table('instruments')
            ->addColumn('dependency', 'string', [
                'after' => 'note',
                'default' => null,
                'length' => 27,
                'null' => true,
            ])
            ->addColumn('image_url', 'string', [
                'after' => 'dependency',
                'default' => null,
                'length' => 500,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('instruments')
            ->removeColumn('dependency')
            ->removeColumn('image_url')
            ->update();
    }
}

