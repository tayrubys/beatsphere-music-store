<?php

namespace App\Controllers;

use App\Models\UrunModel;
use App\Models\KategoriModel;

class UrunController extends BaseController
{
    public function kategori($kategori_id)
    {
        $urunModel = new UrunModel();
        $kategoriModel = new KategoriModel();

        $data['urunler'] = $urunModel->kategoriyeGoreUrunler($kategori_id);
        $data['kategori'] = $kategoriModel->find($kategori_id);

        return view('kategori_urunleri', $data);
    }
}