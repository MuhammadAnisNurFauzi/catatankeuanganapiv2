<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\User';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'nama', 'username', 'email', 'password', 'no_hp', 'alamat', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'username' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[8]',
        'no_hp' => 'required',
        'alamat' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // Relationships
    // Example: Assume a relationship with PemasukanModel
    protected $hasMany = [
        'pemasukan' => [
            'model' => 'App\Models\PemasukanModel',
            'foreign_key' => 'id_user',
        ],
        'pengeluaran' => [
            'model' => 'App\Models\PengeluaranModel',
            'foreign_key' => 'id_user',
        ],
        'laporan' => [
            'model' => 'App\Models\LaporanModel',
            'foreign_key' => 'id_user',
        ],
    ];
}
