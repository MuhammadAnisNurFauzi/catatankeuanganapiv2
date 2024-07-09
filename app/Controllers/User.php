<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

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
        if (!$this->model->find($id_user)) {
            return $this->fail('Data tidak ditemukan');
        }
        return $this->respond($this->model->find($id_user));
    }

    public function create()
    {
        $data = $this->request->getPost();
        $user = new \App\Entities\User();
        $user->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($user)) {
            return $this->respondCreated($data);
        }
    }

    public function update($id_user = null)
    {
        $data = $this->request->getRawInput();
        $data['id_user'] = $id_user;

        if (!$this->model->find($id_user)) {
            return $this->fail('Data tidak ditemukan');
        }

        $user = new \App\Entities\User();
        $user->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($user)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_user = null)
    {
        if (!$this->model->find($id_user)) {
            return $this->fail('Data tidak ditemukan');
        }

        if ($this->model->delete($id_user)) {
            return $this->respondDeleted("Data dengan id user " . $id_user . " berhasil dihapus");
        }
    }
}
