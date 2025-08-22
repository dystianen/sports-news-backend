<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMoments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'moment_id'  => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'sport_id'   => ['type' => 'INT', 'unsigned' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'thumbnail'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'video_url'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('moment_id', true);
        $this->forge->addForeignKey('sport_id', 'sports', 'sport_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('moments');
    }

    public function down()
    {
        $this->forge->dropTable('moments');
    }
}
