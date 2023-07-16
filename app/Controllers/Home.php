<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\TransaksiModel;
use App\Controllers\MainController;

class Home extends MainController
{

    public function index()
    {
        $transaksi = new TransaksiModel();

        $paket = new PaketModel();
        $data = [
            'title' => "Home",
            'transaksi' => $transaksi->orderBy('created_at', 'DESC')->findAll(),
            'transaksiDone' => $transaksi->where('is_paid', 1)->countAllResults(),
            'transaksiWait' => $transaksi->where('is_paid', 0)->countAllResults(),
            'pakets' => $paket->findAll(),
        ];
        return $this->template('dashboard/home', $data);
    }

    public function statusTransaksi()
    {
        $data = $this->request->getGet();
        $transaksi = new TransaksiModel();

        if ($data['is_paid'] == 1) {
            $data['paid_at'] = date('Y-m-d H:i:s');
            $msg = "Status transisaki diubah menjadi sudah dibayar.";
        } else {
            $data['paid_at'] = null;
            $msg = "Status transisaki diubah menjadi belum dibayar.";
        }

        try {
            $transaksi->update($data['id'], $data);
        } catch (\Throwable $th) {
            $res = [
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ];
            return json_encode($res);
        }

        $res = [
            'status' => 200,
            'message' => $msg
        ];
        return json_encode($res);
    }
}