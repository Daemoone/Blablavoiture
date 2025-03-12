<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableTravel extends Migration
{
    public function up()
    {
        $this->forge->addField([
           'id' => [
               'type' => 'INT',
               'constraint' => 11,
               'unsigned' => true,
               'auto_increment' => true,
           ] ,
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_car' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nb_seat' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'comment' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id');
        $this->forge->addForeignKey('id_car', 'car', 'id');
        $this->forge->createTable('travel');
    }

    public function down()
    {
        $this->forge->dropTable('travel');
    }
}
