<?php
use Migrations\AbstractMigration;

class UpdateNotesToDatetime extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->changeColumn('start_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->changeColumn('end_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->changeColumn('start_date', 'date', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->changeColumn('end_date', 'date', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }
}

