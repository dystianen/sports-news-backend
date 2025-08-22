<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('SportSeeder');
        $this->call('ArticlesSeeder');
    }
}
