<?php
use Migrations\AbstractMigration;

class UpdateNotesWithImage extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->addColumn('image_url', 'string', [
                'after' => 'resolved_date',
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->removeColumn('image_url')
            ->update();
    }
}

