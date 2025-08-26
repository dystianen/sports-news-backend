<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMatches extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'match_id'   => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'sport_id'   => ['type' => 'INT', 'unsigned' => true],
            'team_home_id'  => ['type' => 'BIGINT', 'unsigned' => true],
            'team_away_id'  => ['type' => 'BIGINT', 'unsigned' => true],
            'match_date' => ['type' => 'DATETIME'],
            'status'     => ['type' => 'ENUM("upcoming","ongoing","finished","cancelled")', 'default' => 'upcoming'],
            'score_home' => ['type' => 'INT', 'null' => true],
            'score_away' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('match_id', true);

        // relasi ke tabel sports
        $this->forge->addForeignKey('sport_id', 'sports', 'sport_id', 'CASCADE', 'CASCADE');

        // relasi ke tabel teams
        $this->forge->addForeignKey('team_home_id', 'teams', 'team_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_away_id', 'teams', 'team_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('matches');
    }

    public function down()
    {
        $this->forge->dropTable('matches');
    }
}
