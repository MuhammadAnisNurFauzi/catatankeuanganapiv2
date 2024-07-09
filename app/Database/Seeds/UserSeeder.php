<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Muhammad Anis Nur Fauzi',
                'username' => 'Fauzi',
                'email' => 'fauzi8@gmail.com',
                'password' => '12345678',
                'no_hp' => '081226592425',
                'alamat' => 'Jipang',
            ],
            // Add more user data here
        ];
    
        $this->db->table('user')->insertBatch($data);
    
    }
}
