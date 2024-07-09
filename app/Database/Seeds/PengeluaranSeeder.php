<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nominal' => 50000,
                'catatan' => 'Belanja',
                'tgl_pengeluaran' => '2024-07-02',
            ],
            // Add more pengeluaran data here
        ];
        $this->db->table('pengeluaran')->insertBatch($data);
        
    }
}
