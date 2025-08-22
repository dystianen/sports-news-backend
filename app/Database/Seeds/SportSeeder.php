<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SportSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Sepak Bola', 'slug' => 'sepak-bola', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Basket', 'slug' => 'basket', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Bulu Tangkis', 'slug' => 'bulu-tangkis', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Mobile Legend', 'slug' => 'mobile-legend', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Valorant', 'slug' => 'valorant', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Dota', 'slug' => 'dota', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('sports')->insertBatch($data);
    }
}
