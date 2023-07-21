<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PaketModel;
use App\Models\TransaksiModel;

class LaporanController extends MainController
{
    public function laporanTransaksi()
    {
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        $title = date('d F Y', strtotime((string)$start));
        if ($this->request->getGet('title')) {
            $title = date('d F Y', strtotime((string)$start)) . ' - ' . date('d F Y', strtotime((string)$end));
        }
        $data['title'] = 'Laporan Transaksi ' . $title;

        $transaksi = new TransaksiModel();
        $paket = new PaketModel();

        $result = $transaksi->where('is_paid', 1)->Where('created_at >=', $start)->Where('created_at <=', $end)->get()->getResult();
        $data['transaksi'] = $result;
        $data['pakets'] = $paket->findAll();
        return $this->template('dashboard/laporan/laporan_transaksi', $data);
    }
}
