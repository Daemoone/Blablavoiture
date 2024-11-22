<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableWarning extends Migration
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
            'entity_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'entity_type' => [
                'type' => 'ENUM',
                'constraint' => ['user','reservation','comment','message','travel'],
            ],
            'id_sender' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_moderator' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'priority' => [
                'type' => 'ENUM',
                'constraint' => ['low','medium','high'],
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
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_sender','user','id');
        $this->forge->addForeignKey('id_moderator','user','id');
        $this->forge->createTable('warning');
    }

    public function down()
    {
        $this->forge->dropTable('warning');
    }
}
