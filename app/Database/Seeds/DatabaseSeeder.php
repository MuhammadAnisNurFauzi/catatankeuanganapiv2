<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call individual seeders
        $this->call('UserSeeder');
        $this->call('LaporanSeeder');
        $this->call('TransaksiSeeder');
        $this->call('PemasukanSeeder');
        $this->call('PengeluaranSeeder');
    }
}
