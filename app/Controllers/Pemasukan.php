<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pemasukan extends ResourceController
{
    protected $modelName = 'App\Models\PemasukanModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id_pemasukan = null)
    {
        if (!$this->model->find($id_pemasukan)) {
            return $this->fail('Data tidak ditemukan');
        }
        return $this->respond($this->model->find($id_pemasukan));
    }

    public function create()
    {
        $data = $this->request->getPost();
        $pemasukan = new \App\Entities\Pemasukan();
        $pemasukan->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($pemasukan)) {
            return $this->respondCreated($data);
        }
    }

    public function update($id_pemasukan = null)
    {
        $data = $this->request->getRawInput();
        $data['id_pemasukan'] = $id_pemasukan;

        if (!$this->model->find($id_pemasukan)) {
            return $this->fail('Data tidak ditemukan');
        }

        $pemasukan = new \App\Entities\Pemasukan();
        $pemasukan->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($pemasukan)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_pemasukan = null)
    {
        if (!$this->model->find($id_pemasukan)) {
            return $this->fail('Data tidak ditemukan');
        }

        if ($this->model->delete($id_pemasukan)) {
            return $this->respondDeleted("Data dengan id pemasukan " . $id_pemasukan . " berhasil dihapus");
        }
    }
}
