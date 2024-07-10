<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class User extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id_user = null)
    {
        $user = $this->model->find($id_user);
        if (!$user) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond($user);
    }

    public function create()
    {
        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]',
            'no_hp' => 'required',
            'alamat' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
        ];

        $userModel = new UserModel();
        $userModel->insert($data);

        return $this->respondCreated(['status' => 201, 'message' => 'User created successfully']);
    }

    public function update($id_user = null)
    {
        $data = $this->request->getRawInput();
        $data['id_user'] = $id_user;

        if (!$this->model->find($id_user)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->model->save($data)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_user = null)
    {
        if (!$this->model->find($id_user)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if ($this->model->delete($id_user)) {
            return $this->respondDeleted(['status' => 200, 'message' => "Data dengan id user $id_user berhasil dihapus"]);
        }
    }

    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->failNotFound('Email tidak ditemukan');
        }

        if (!password_verify($password, $user->password)) {
            return $this->fail('Password salah');
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Login berhasil',
            'data' => $user // Exclude sensitive data in a real application
        ]);
    }
}