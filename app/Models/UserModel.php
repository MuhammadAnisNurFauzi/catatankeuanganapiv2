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
        'email' => 'required|valid_email|is_unique[user.email,id_user,{id_user}]',
        'password' => 'required|min_length[8]',
        'no_hp' => 'required',
        'alamat' => 'required',
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi',
        ],
        'username' => [
            'required' => 'Username harus diisi',
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password harus terdiri dari setidaknya 8 karakter',
        ],
        'no_hp' => [
            'required' => 'Nomor HP harus diisi',
        ],
        'alamat' => [
            'required' => 'Alamat harus diisi',
        ],
    ];
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

    // Define relationships
    public function pemasukan()
    {
        return $this->hasMany('App\Models\PemasukanModel', 'id_user', 'id_user');
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Models\PengeluaranModel', 'id_user', 'id_user');
    }

    public function laporan()
    {
        return $this->hasMany('App\Models\LaporanModel', 'id_user', 'id_user');
    }
}
