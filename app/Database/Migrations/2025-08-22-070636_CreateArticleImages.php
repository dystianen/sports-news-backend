<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'article_image_id' => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'article_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'image_url'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'caption'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('article_image_id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'article_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('article_images');
    }

    public function down()
    {
        $this->forge->dropTable('article_images');
    }
}
