<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Image extends Migration
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
            'url'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_post' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'          => true,
            ],
            'alt_text'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'caption_text'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('images');
    }

    public function down()
    {
        $this->forge->dropTable('images');
    }
}
