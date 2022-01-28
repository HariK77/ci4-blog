<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'type'          => [
                'type'        => 'TINYINT',
                'constraint'     => 1,
                'default'       => 0,
                'comment'       => '0 => Normal User, 1 => Admin'
            ],
            'email_verified' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment'       => '0 => Not Verified, 1 => Verified'
            ],
            'created_at'       => [
                'type'       => 'TIMESTAMP',
                'default'     => null,
            ],
            'updated_at'       => [
                'type'       => 'TIMESTAMP',
                'default'     => null,
            ],
            'deleted_at'       => [
                'type'       => 'TIMESTAMP',
                'default'     => null,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
