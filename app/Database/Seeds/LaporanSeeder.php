<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run()
    {
        // Example data
        $data = [
            [
                'id_user' => 3,
                'saldo' => 50000,
                'total_pemasukan' => 100000,
                'total_pengeluaran' => 50000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Add more data as needed
        ];

        // Using Query Builder to insert data
        $this->db->table('laporan')->insertBatch($data);
    }
}
