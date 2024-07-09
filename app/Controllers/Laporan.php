<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Laporan extends ResourceController
{
    protected $modelName = 'App\Models\LaporanModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id_laporan = null)
    {
        if (!$this->model->find($id_laporan)) {
            return $this->fail('Data tidak ditemukan');
        }
        return $this->respond($this->model->find($id_laporan));
    }

    public function create()
    {
        $data = $this->request->getPost();
        $laporan = new \App\Entities\Laporan();
        $laporan->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($laporan)) {
            return $this->respondCreated($data);
        }
    }

    public function update($id_laporan = null)
    {
        $data = $this->request->getRawInput();
        $data['id_laporan'] = $id_laporan;

        if (!$this->model->find($id_laporan)) {
            return $this->fail('Data tidak ditemukan');
        }

        $laporan = new \App\Entities\Laporan();
        $laporan->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($laporan)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_laporan = null)
    {
        if (!$this->model->find($id_laporan)) {
            return $this->fail('Data tidak ditemukan');
        }

        if ($this->model->delete($id_laporan)) {
            return $this->respondDeleted("Data dengan id laporan " . $id_laporan . " berhasil dihapus");
        }
    }
}
