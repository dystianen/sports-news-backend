<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'article_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'user_id'    => ['type' => 'BIGINT', 'unsigned' => true],
            'comment'    => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('comment_id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'article_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
