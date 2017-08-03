<?php
use Migrations\AbstractMigration;

class AddAssetToNotes extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->addColumn('asset_uid', 'string', [
                'after' => 'deployment',
                'default' => null,
                'length' => 20,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->removeColumn('asset_uid')
            ->update();
    }
}

