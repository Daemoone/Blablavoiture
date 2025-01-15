<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableJeton extends Migration
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
            'id_reservation' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total_jeton' => [
                'type' => 'DECIMAL'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
