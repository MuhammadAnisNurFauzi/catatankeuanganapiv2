<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PemasukanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nominal' => 100000,
                'catatan' => 'Gaji',
                'tgl_pemasukan' => '2024-07-01',
            ],
            // Add more pemasukan data here
        ];

        $this->db->table('pemasukan')->insertBatch($data);
        
    }
}
