<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNewColumnsToUser extends Migration
{
    public function up()
    {
        $fields = [
            'remember_token' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'password'
            ],
            'password_reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'remember_token'
            ],
        ];

        // // Will place the new column after the `another_field` column:
        // $fields = [
        //     'preferences' => ['type' => 'TEXT', 'after' => 'another_field']
        // ];

        // // Will place the new column at the start of the table definition:
        // $fields = [
        //     'preferences' => ['type' => 'TEXT', 'first' => true]
        // ];

        // for modifying the columns
        // $fields = [
        //     'old_name' => [
        //         'name' => 'new_name',
        //         'type' => 'TEXT',
        //     ],
        // ];
        // $this->forge->modifyColumn('table_name', $fields);

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        // $this->forge->dropColumn('table_name', 'column_to_drop'); // to drop one single column
        // $this->forge->dropColumn('table_name', 'column_1,column_2'); // by proving comma separated column names
        $this->forge->dropColumn('users', ['remember_token', 'password_reset_token']); // by proving array of column names
    }
}
