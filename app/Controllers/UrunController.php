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
    /*public function detay($id){
       $urunModel = new \App\Models\UrunModel();

       $urun = $urunModel->find($id);

       if (!$urun) {
          throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

      $data['urun'] = $urun;

      return view('urun_detay', $data);
    }*/
      public function detay($id)
{
    $urunModel = new \App\Models\UrunModel();

    $urun = $urunModel->find($id);

    if (!$urun) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $benzerUrunler = $urunModel
        ->where('kategori_id', $urun['kategori_id'])
        ->where('id !=', $id)
        ->where('durum', 'satista')
        ->limit(4)
        ->findAll();

    $data['urun'] = $urun;
    $data['benzerUrunler'] = $benzerUrunler;

    return view('urun_detay', $data);
}
}