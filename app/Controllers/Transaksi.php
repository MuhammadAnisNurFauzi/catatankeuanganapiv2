<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Transaksi extends ResourceController
{
    protected $modelName = 'App\Models\TransaksiModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id_transaksi = null)
    {
        if (!$this->model->find($id_transaksi)) {
            return $this->fail('Data tidak ditemukan');
        }
        return $this->respond($this->model->find($id_transaksi));
    }

    public function create()
    {
        $data = $this->request->getPost();
        $transaksi = new \App\Entities\Transaksi();
        $transaksi->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($transaksi)) {
            return $this->respondCreated($data);
        }
    }

    public function update($id_transaksi = null)
    {
        $data = $this->request->getRawInput();
        $data['id_transaki'] = $id_transaksi;

        if (!$this->model->find($id_transaksi)) {
            return $this->fail('Data tidak ditemukan');
        }

        $transaksi = new \App\Entities\Transaksi();
        $transaksi->fill($data);

        if (!$this->validate($this->model->validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        if ($this->model->save($transaksi)) {
            return $this->respondUpdated($data);
        }
    }

    public function delete($id_transaksi = null)
    {
        if (!$this->model->find($id_transaksi)) {
            return $this->fail('Data tidak ditemukan');
        }

        if ($this->model->delete($id_transaksi)) {
            return $this->respondDeleted("Data dengan id transaksi " . $id_transaksi . " berhasil dihapus");
        }
    }
}
