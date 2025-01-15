<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableEtape extends Migration
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
            'id_travel' => [
              'type' => 'INT',
              'constraint' => 11,
              'unsigned' => true,
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'id_city_departure' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'adress_departure' => [
                'type' => 'TEXT',
            ],
            'date_departure' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'nb_seat' => [
                'type' => 'INT',
                'constraint' => 2,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_travel','travel', 'id');
        $this->forge->addForeignKey('id_city_departure','city', 'id');
        $this->forge->createTable('etape');
    }

    public function down()
    {
        $this->forge->dropTable('etape');
    }
}
