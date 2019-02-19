<?php
use Migrations\AbstractMigration;

class UpdateURLs extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->changeColumn('image_url', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->update();

        $this->table('nuggets')
            ->changeColumn('graph_link', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->changeColumn('notebook_link', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->changeColumn('data_link', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->changeColumn('image_url', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->update();

        $this->table('nuggets')
            ->changeColumn('graph_link', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->changeColumn('notebook_link', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->changeColumn('data_link', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->update();
    }
}

