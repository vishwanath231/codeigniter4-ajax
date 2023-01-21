<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'phone' => [
                'type' => 'BIGINT',
                'constraint' => '12'
            ],
            'date timestamp default current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down(){
        
        $this->forge->dropTable('users');
    }
}
