<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'article_id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'sport_id'   => ['type' => 'INT', 'unsigned' => true],
            'user_id'    => ['type' => 'BIGINT', 'unsigned' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'thumbnail'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'content'    => ['type' => 'LONGTEXT'],
            'type'       => ['type' => 'ENUM("trending","news","latest")', 'default' => 'news'],
            'views'      => ['type' => 'INT', 'default' => 0],
            'likes'      => ['type' => 'INT', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('article_id', true);
        $this->forge->addForeignKey('sport_id', 'sports', 'sport_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}
