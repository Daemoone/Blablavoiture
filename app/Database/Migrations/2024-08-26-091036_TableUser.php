<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100',
                'null'=>true,
            ],
            'first_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100',
                'null'=>true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

            'id_permission' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'phone' => [
                'type'=>'VARCHAR',
                'constraint'=> 20,
                'null'=>false,
                'after'=>'family_name'
            ],
            'cagnotte' => [
                'type' => 'INT',
                'constraint' => '11',
                'after' => 'id_license',
                'default' => 0
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}