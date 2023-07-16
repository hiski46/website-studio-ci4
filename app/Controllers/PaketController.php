<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PaketCategoryModel;
use App\Models\PaketModel;
use CodeIgniter\Files\File;

class PaketController extends MainController
{
    protected $Paket;
    protected $PaketCategory;

    public function __construct()
    {
        parent::__construct();
        $this->Paket = new PaketModel();
        $this->PaketCategory = new PaketCategoryModel();
    }

    public function index()
    {
        $data['title'] = 'Daftar Shop';
        $data['paket'] = $this->Paket->orderBy('created_at', 'desc')->findAll();
        $data['kategori'] = $this->PaketCategory->findAll();
        return $this->template('dashboard\paket\all_paket', $data);
    }

    public function halamanTambah()
    {
        $data['title'] = 'Tambah Shop';
        $data['kategori'] = $this->PaketCategory->findAll();

        return $this->template('dashboard\paket\add_paket', $data);
    }

    public function tambah()
    {
        $data = $this->request->getPost();
        $imgTemp = $this->request->getFile('image');
        if ($imgTemp->isFile()) {
            if (!$imgTemp->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $imgTemp->store();
                $data['image'] = $imgTemp->getName();
                $file = new File($filepath);
                $file->move(ROOTPATH . '\public\paket');
            }
        }

        $this->Paket->insert($data);
        $this->session->setFlashdata('pesan', "Shop berhasil ditambah");
        return redirect('paket/list');
    }

    public function halamanEdit($id)
    {
        $data['paket'] = $this->Paket->find($id);
        $data['title'] = 'Edit Shop ' . $data['paket']->title;
        $data['kategori'] = $this->PaketCategory->findAll();

        return $this->template('dashboard\paket\edit_paket', $data);
    }
    public function edit($id)
    {
        $data = $this->request->getPost();
        $imgTemp = $this->request->getFile('new-image');
        if ($imgTemp->isFile()) {
            if (!$imgTemp->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $imgTemp->store();
                $data['image'] = $imgTemp->getName();
                $file = new File($filepath);
                $file->move(ROOTPATH . '\public\paket');
            }
        }
        $this->Paket->update($id, $data);
        $this->session->setFlashdata('pesan', "Shop berhasil diubah");
        return redirect('paket/list');
    }

    public function delete($id)
    {
        if ($this->Paket->delete($id)) {
            $msg = [
                'status' => 200,
                'message' => 'Shop berhasil dihapus'
            ];
            $this->session->setFlashdata('pesan', $msg['message']);
            return json_encode($msg);
        }
    }

    public function status()
    {
        $status = $this->request->getGet('status');
        $id = $this->request->getGet('id');
        try {
            $this->Paket->update($id, ['is_active' => (int)$status]);
        } catch (\Throwable $th) {
            $data = [
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ];
            return json_encode($data);
        }
        if ($status) {
            $msg = "Shop berhasil diaktifkan.";
        } else {
            $msg = "Shop berhasil dinonaktifkan.";
        }

        $data = [
            'status' => 200,
            'message' => $msg
        ];
        return json_encode($data);
    }
}
