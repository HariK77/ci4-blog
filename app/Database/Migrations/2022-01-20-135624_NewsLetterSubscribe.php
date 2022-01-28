<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NewsLetterSubscribe extends Migration
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
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 150,
				'unique' => true,
			],
			'subscribed_at datetime default current_timestamp',
			// 'updated_at datetime default current_timestamp on update current_timestamp',
			// 'subscribed_at'       => [
			// 	'type'       => 'DATETIME',
			// 	'default'	 => 'CURRENT_TIMESTAMP',
			// ],
			'unsubscribed_at' => [
				'type'       => 'DATETIME',
				'default'	 => null,
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('news_letter_subscribe');
    }

    public function down()
    {
		$this->forge->dropTable('news_letter_subscribe');
    }
}
