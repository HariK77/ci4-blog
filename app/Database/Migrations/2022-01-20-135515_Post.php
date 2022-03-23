<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
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
            'id_user'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_category'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'sub_title'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
            ],
            'slug'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'post_content'       => [
                'type'       => 'TEXT'
            ],
            'header_image' => [
                'type'       => 'TEXT',
            ],
            // 'id_image_one' => [
            //     'type'           => 'INT',
            //     'constraint'     => 11,
            //     'unsigned'       => true,
            // ],
            // 'id_image_two' => [
            //     'type'           => 'INT',
            //     'constraint'     => 11,
            //     'unsigned'       => true,
            // ],
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
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_category', 'categories', 'id');
        // $this->forge->addForeignKey('id_header_image', 'images', 'id');
        // $this->forge->addForeignKey('id_image_one', 'images', 'id');
        // $this->forge->addForeignKey('id_image_two', 'images', 'id');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
