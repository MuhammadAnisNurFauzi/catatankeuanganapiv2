<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pengeluaran extends ResourceController
{
    protected $modelName = 'App\Models\PengeluaranModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id_pengeluaran = null)
    {
        if (!$this->model->find($id_pengeluaran)) {
            return $this->fail('Data tidak ditemukan');
        }
        return $this->respond($this->model->find($id_pengeluaran));
    }

    public function create()
    {
        $data = $this->request->getPost();
        $pengeluaran = new \App\Entities\Pengeluaran();
        $pengeluaran->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($pengeluaran)) {
            return $this->respondCreated($data);
        }
    }

    public function update($id_pengeluaran = null)
    {
        $data = $this->request->getRawInput();
        $data['id_pengeluaran'] = $id_pengeluaran;

        if (!$this->model->find($id_pengeluaran)) {
            return $this->fail('Data tidak ditemukan');
        }

        $pengeluaran = new \App\Entities\Pengeluaran();
        $pengeluaran->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($pengeluaran)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_pengeluaran = null)
    {
        if (!$this->model->find($id_pengeluaran)) {
            return $this->fail('Data tidak ditemukan');
        }

        if ($this->model->delete($id_pengeluaran)) {
            return $this->respondDeleted("Data dengan id pengeluaran " . $id_pengeluaran . " berhasil dihapus");
        }
    }
}
