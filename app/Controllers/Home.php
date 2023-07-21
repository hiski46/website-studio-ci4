<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\TransaksiModel;
use App\Controllers\MainController;

class Home extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $transaksi = new TransaksiModel();

        $pengunjunghariini  = $this->visitor->db->query("SELECT * FROM visitor WHERE date='" . date("Y-m-d") . "' GROUP BY ip")->getNumRows(); // Hitung jumlah pengunjung

        $dbpengunjung = $this->visitor->db->query("SELECT COUNT(hits) as hits FROM visitor")->getRow();

        $totalpengunjung = isset($dbpengunjung->hits) ? ($dbpengunjung->hits) : 0; // hitung total pengunjung

        $bataswaktu = time() - 300;

        $pengunjungonline  = $this->visitor->db->query("SELECT * FROM visitor WHERE online > '" . $bataswaktu . "'")->getNumRows(); // hitung pengunjung online

        $paket = new PaketModel();
        $batas_waktu = date("Y-m-d H:i:s", strtotime("-10 minutes"));
        $data = [
            'title' => "Home",
            'transaksi' => $transaksi->orderBy('created_at', 'DESC')->where('is_paid', 1)->orWhere('created_at >=', $batas_waktu)->get()->getResult(),
            'transaksiDone' => $transaksi->where('is_paid', 1)->countAllResults(),
            'transaksiWait' => $transaksi->where('is_paid', 0)->where('created_at >=', $batas_waktu)->countAllResults(),
            'pakets' => $paket->findAll(),
        ];
        $data['pengunjunghariini'] = $pengunjunghariini;
        $data['totalpengunjung'] = $totalpengunjung;
        $data['pengunjungonline'] = $pengunjungonline;
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
