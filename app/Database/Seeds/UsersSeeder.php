<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Admin Utama',
                'email'      => 'admin@sportsnews.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'avatar'     => '/uploads/avatars/admin.png',
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Ichsan Furqon',
                'email'      => 'ichsan@sportsnews.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'avatar'     => '/uploads/avatars/ichsan.png',
                'role'       => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Budi Santoso',
                'email'      => 'budi@sportsnews.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'avatar'     => '/uploads/avatars/budi.png',
                'role'       => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Insert batch
        $this->db->table('users')->insertBatch($data);
    }
}
