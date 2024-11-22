<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'family_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100',
                'null'=>true,
                'after'=>'username'
            ],
            'phone' => [
                'type'=>'VARCHAR',
                'constraint'=> 20,
                'null'=>false,
                'after'=>'family_name'
            ],
            'id_card' => [
                'type' => 'INT',
                'constraint' => '11',
                'after' => 'password',
                'null' => false,
            ],
            'id_license' => [
                'type' => 'INT',
                'constraint' => '11',
                'after' => 'id_card'
            ],
            'id_avatar' =>[
                'type' => 'INT',
                'constraint' => '11',
                'after' => 'id_license'
            ],
            'cagnotte' => [
                'type' => 'INT',
                'constraint' => '11',
                'after' => 'id_license',
                'default' => 0
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'family_name');
        $this->forge->dropColumn('user', 'phone');
        $this->forge->dropColumn('user', 'id_card');
        $this->forge->dropColumn('user', 'id_license');
        $this->forge->dropColumn('user', 'id_avatar');
        $this->forge->dropColumn('user', 'cagnotte');
    }
}
