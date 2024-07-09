<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user' => 3, // Assuming user with ID 1 exists
                'id_pemasukan' => 4, // Assuming pemasukan with ID 1 exists
                'id_pengeluaran' => 2, // Assuming pengeluaran with ID 1 exists
            ],
            // Add more transaksi data here
        ];

        $this->db->table('transaksi')->insertBatch($data);
        
    }
}
