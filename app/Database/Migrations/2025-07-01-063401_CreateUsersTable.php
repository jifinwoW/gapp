<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 191, 
                'unique'     => true,
            ],

            'name'            => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'phone'           => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'access_token'    => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'refresh_token'   => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'token_expires'   => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at'      => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at'      => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
