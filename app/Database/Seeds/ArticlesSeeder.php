<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sport_id'   => 1, // sepak bola
                'user_id'    => 1, // author id
                'title'      => 'Timnas Indonesia Menang di Kualifikasi Piala Dunia',
                'slug'       => 'timnas-indonesia-menang-di-kualifikasi-piala-dunia',
                'thumbnail'  => '/uploads/articles/timnas.jpg',
                'content'    => '<p>Timnas Indonesia berhasil mengalahkan lawannya dengan skor 2-1...</p>',
                'type'       => 'trending',
                'views'      => 120,
                'likes'      => 30,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'sport_id'   => 2, // basket
                'user_id'    => 1,
                'title'      => 'Raja Baru Basket Indonesia!',
                'slug'       => 'raja-baru-basket-indonesia',
                'thumbnail'  => '/uploads/articles/basket.jpg',
                'content'    => '<p>Dewa United keluar sebagai juara baru IBL 2025...</p>',
                'type'       => 'news',
                'views'      => 80,
                'likes'      => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'sport_id'   => 3, // e-sport (misalnya Valorant)
                'user_id'    => 2,
                'title'      => 'Team RRQ Juarai Turnamen Valorant',
                'slug'       => 'team-rrq-juarai-turnamen-valorant',
                'thumbnail'  => '/uploads/articles/valorant.jpg',
                'content'    => '<p>RRQ berhasil mengalahkan lawannya di final turnamen Valorant Asia...</p>',
                'type'       => 'latest',
                'views'      => 150,
                'likes'      => 45,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert batch
        $this->db->table('articles')->insertBatch($data);
    }
}
