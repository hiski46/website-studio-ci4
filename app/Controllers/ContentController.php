<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\BiodataModel;
use App\Models\CarouselModel;
use App\Models\PortofolioModel;
use CodeIgniter\Files\File;

class ContentController extends MainController
{
    public function portofolio()
    {
        $data['title'] = 'Portofolio';
        $portofolioModel = new PortofolioModel();
        $data['portofolio'] = $portofolioModel->findAll();
        return $this->template('dashboard/content/portofolio', $data);
    }
    public function biodata()
    {
        $biodataModel = new BiodataModel();
        $data = $biodataModel->getBiodata();
        $data['title'] = 'Biodata';
        return $this->template('dashboard/content/biodata', $data);
    }
    public function carousel()
    {
        $data['title'] = 'Carousel';
        $carouselModel = new CarouselModel();
        $data['carousel'] = $carouselModel->findAll();
        return $this->template('dashboard/content/carousel', $data);
    }

    public function halamanAddPortofolio()
    {
        $data['title'] = 'Tambah Portofolio';
        return $this->template('dashboard/content/add_portofolio', $data);
    }
    public function addPortofolio()
    {
        $data['is_active'] = 1;
        $files = $this->request->getFileMultiple('portofolio');
        $portofolio = [];
        foreach ($files as $file) {
            if ($file->isFile()) {
                if (!$file->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads/' . $file->store();
                    $portofolio[] = $file->getName();
                    $file = new File($filepath);
                    $file->move(ROOTPATH . '\public\portofolio');
                }
            }
        }
        $data['portofolio'] = json_encode($portofolio);
        $portofolioModel = new PortofolioModel();
        $save = $portofolioModel->save($data);
        if ($save) {
            $this->session->setFlashdata('pesan', "Portofolio berhasil ditambah");
            return redirect('content/portofolio');
        }
    }

    public function halamanEditPortofolio($id)
    {
        $portofolioModel = new PortofolioModel();
        $data['title'] = "Edit Portofolio";
        $data['portofolio'] = $portofolioModel->find($id);
        return $this->template('dashboard/content/edit_portofolio', $data);
    }

    public function deleteFoto($id)
    {
        $foto = $this->request->getGet('foto');
        $portofolioModel = new PortofolioModel();
        $portofolio = $portofolioModel->find($id);
        $allfoto = json_decode($portofolio->portofolio);
        unset($allfoto[array_search($foto, $allfoto)]);
        $edit = $portofolioModel->update($id, ['portofolio' => json_encode($allfoto)]);
        if ($edit) {
            $msg = [
                'status' => 200,
                'message' => 'Foto berhasil dihapus'
            ];
            $this->session->setFlashdata('pesan', $msg['message']);
            return json_encode($msg);
        }
    }

    public function editPortofolio($id)
    {
        $portofolioModel = new PortofolioModel();
        $portofolio = $portofolioModel->find($id);
        $allfoto = json_decode($portofolio->portofolio);
        $files = $this->request->getFileMultiple('portofolio');
        foreach ($files as $file) {
            if ($file->isFile()) {
                if (!$file->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads/' . $file->store();
                    $allfoto[] = $file->getName();
                    $file = new File($filepath);
                    $file->move(ROOTPATH . '\public\portofolio');
                }
            }
        }
        $data['portofolio'] = json_encode($allfoto);
        $update = $portofolioModel->update($id, $data);
        if ($update) {
            $this->session->setFlashdata('pesan', "Portofolio berhasil diubah");
            return redirect('content/portofolio');
        }
    }

    public function statusPortofolio()
    {
        $portofolio = new PortofolioModel();
        $status = $this->request->getGet('status');
        $id = $this->request->getGet('id');
        try {
            $portofolio->update($id, ['is_active' => (int)$status]);
        } catch (\Throwable $th) {
            $data = [
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ];
            return json_encode($data);
        }
        if ($status) {
            $msg = "Portofolio berhasil diaktifkan.";
        } else {
            $msg = "Portofolio berhasil dinonaktifkan.";
        }

        $data = [
            'status' => 200,
            'message' => $msg
        ];
        return json_encode($data);
    }

    public function deletePortofolio($id)
    {

        $portofolio = new PortofolioModel();
        $portofolio->delete($id);
        if ($portofolio->db->affectedRows() > 0) {
            $msg = [
                'status' => 200,
                'message' => 'Portofolio berhasil dihapus'
            ];
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Portofolio gagal dihapus'
            ];
        }

        $this->session->setFlashdata('pesan', $msg['message']);
        return json_encode($msg);
    }

    public function biodataSave()
    {
        $data = $this->request->getPost();
        $imgTemp = $this->request->getFile('new-image');
        if ($imgTemp->isFile()) {
            if (!$imgTemp->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $imgTemp->store();
                $data['logo'] = $imgTemp->getName();
                $file = new File($filepath);
                $file->move(ROOTPATH . '\public\image');
            }
        }
        $biodata = [];
        foreach ($data as $key => $value) {
            $biodata[] = ['biodata' => $key, 'value' => $value];
        }
        $biodataModel = new BiodataModel();
        $biodataModel->updateBatch($biodata, 'biodata');


        $this->session->setFlashdata('pesan', "Biodata berhasil diubah");
        return redirect('content/biodata');
    }

    public function halamanTambahCarousel()
    {
        $data['title'] = 'Tambah Caraousel';

        return $this->template('dashboard/content/add_carousel', $data);
    }

    public function tambahCarousel()
    {
        $imgTemp = $this->request->getFile('img');
        if ($imgTemp->isFile()) {
            if (!$imgTemp->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $imgTemp->store();
                $data['img'] = $imgTemp->getName();
                $file = new File($filepath);
                $file->move(ROOTPATH . '\public\carousel');
            }
        }

        $carouselModel = new CarouselModel();
        $carouselModel->save($data);
        $this->session->setFlashdata('pesan', "Carousel berhasil ditambah");
        return redirect('content/carousel');
    }

    public function deleteCarousel($id)
    {
        $carousel = new CarouselModel();
        if ($carousel->delete($id)) {
            $msg = [
                'status' => 200,
                'message' => 'Carousel berhasil dihapus'
            ];
            $this->session->setFlashdata('pesan', $msg['message']);
            return json_encode($msg);
        }
    }
}
