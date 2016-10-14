<?php
use Migrations\AbstractMigration;

class UpdatePreload extends AbstractMigration
{

    public function up()
    {

        $this->table('parameters')
            ->addColumn('data_level', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('data_product_type', 'string', [
                'default' => null,
                'length' => 50,
                'null' => true,
            ])
            ->update();

        $this->table('streams')
            ->removeColumn('display_name')
            ->changeColumn('stream_type', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
            ])
            ->update();

        $this->table('streams')
            ->addColumn('stream_content', 'string', [
                'default' => null,
                'length' => 250,
                'null' => true,
                'after' => 'stream_type',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('parameters')
            ->removeColumn('data_level')
            ->removeColumn('data_product_type')
            ->update();

        $this->table('streams')
            ->addColumn('display_name', 'string', [
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->changeColumn('stream_type', 'string', [
                'default' => null,
                'length' => 20,
                'null' => true,
            ])
            ->removeColumn('stream_content')
            ->update();
    }
}

