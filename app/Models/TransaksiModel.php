<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\Transaksi';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_transaksi', 'id_user', 'id_pemasukan', 'id_pengeluaran', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_user' => 'required|numeric',
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
    protected $belongsTo = [
        'user' => [
            'model' => 'App\Models\UserModel',
            'foreign_key' => 'id_user',
        ],
        'pemasukan' => [
            'model' => 'App\Models\PemasukanModel',
            'foreign_key' => 'id_pemasukan',
        ],
        'pengeluaran' => [
            'model' => 'App\Models\PengeluaranModel',
            'foreign_key' => 'id_pengeluaran',
        ],
    ];
}
