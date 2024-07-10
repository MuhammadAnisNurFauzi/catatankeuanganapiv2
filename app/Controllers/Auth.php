<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        // Mengambil data dari request
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Memeriksa apakah username dan password tidak kosong
        if (empty($email) || empty($password)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                                  ->setJSON(['message' => 'Email dan password wajib diisi']);
        }

        // Menginisialisasi model
        $userModel = new UserModel();

        // Memeriksa pengguna berdasarkan username dan password
        $user = $userModel->where('email', $email)
                          ->where('password') 
                          ->first();

        // Jika pengguna ditemukan
        if ($user) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                                  ->setJSON(['message' => 'Login berhasil', 'user' => $user]);
        }

        // Jika pengguna tidak ditemukan
        return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                              ->setJSON(['message' => 'Email atau password salah']);
    }
}
