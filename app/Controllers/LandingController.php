<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\BiodataModel;
use App\Models\CarouselModel;
use App\Models\PaketCategoryModel;
use App\Models\PaketModel;
use App\Models\PortofolioModel;
use App\Models\TransaksiModel;

class LandingController extends MainController
{
    public function index()
    {
        $biodata = new BiodataModel();
        $portofolio = new PortofolioModel();
        $carousel = new CarouselModel();
        $data = $biodata->getBiodata();
        $data['carousel'] = $carousel->findAll();
        $data['title'] = 'Home';
        $data['nav_active'] = 'home';
        $data['porto'] = $portofolio->where('is_active', 1)->findAll();
        return $this->templateLanding('landingpage/home', $data);
    }

    public function paket()
    {
        $category_id = $this->request->getGet('category');
        $paket = new PaketModel();
        $category = new PaketCategoryModel();

        $biodata = new BiodataModel();
        $data = $biodata->getBiodata();
        $data['title'] = 'Shop';

        if (!$category_id) {
            $data['paket'] = $paket->where('is_active', 1)->orderBy('created_at', 'desc')->findAll();
            $data['active'] = 'category-all';
        } elseif ($category_id == 'promo') {
            $data['paket'] = $paket->where('is_active', 1)->whereNotIn('price_disc', [0])->orderBy('created_at', 'desc')->findAll();
            $data['active'] = 'category-promo';
        } else {
            $data['paket'] = $paket->where('is_active', 1)->where('category_id', $category_id)->orderBy('created_at', 'desc')->findAll();
            $data['active'] = 'category-' . $category_id;
        }
        $data['category'] = $category->findAll();
        $data['nav_active'] = 'paket';
        return $this->templateLanding('landingpage/paket', $data);
    }

    public function detailPaket($id)
    {
        $biodata = new BiodataModel();
        $data = $biodata->getBiodata();
        $paket = new PaketModel();
        $data['paket'] = $paket->find($id);
        $category = new PaketCategoryModel();
        $data['kategori'] = $category->find($data['paket']->category_id);
        $data['nav_active'] = 'paket';
        return $this->templateLanding('landingpage/detail_paket', $data);
    }

    public function cart()
    {
        $biodata = new BiodataModel();
        $data = $biodata->getBiodata();
        $paket = new PaketModel();
        $data['paket'] = json_encode($paket->where('is_active', 1)->orderBy('created_at', 'desc')->findAll());
        $data['nav_active'] = 'cart';
        return $this->templateLanding('landingpage/cart', $data);
    }

    public function checkout()
    {
        $transaksi = new TransaksiModel();
        $data = $this->request->getPost();
        $data['kode_transaksi'] = $transaksi->auto_generate();

        $transaksi->save($data);
        return redirect('/');
    }
}
