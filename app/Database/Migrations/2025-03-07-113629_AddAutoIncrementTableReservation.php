<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAutoIncrementTableReservation extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('reservation',
            ['id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
            ],
        ]
        );
    }

    public function down()
    {
        $this->forge->dropColumn('reservation','id');
    }
}
