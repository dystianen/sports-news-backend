<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sport_id'   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('sport_id', true);
        $this->forge->createTable('sports');
    }

    public function down()
    {
        $this->forge->dropTable('sports');
    }
}
