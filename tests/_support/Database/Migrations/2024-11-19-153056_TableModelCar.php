<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableModelCar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'id_brand' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_brand', 'brand', 'id');
        $this->forge->createTable('modelcar');
    }

    public function down()
    {
        $this->forge->dropTable('modelcar');
    }
}
