<?php

namespace App\Controllers;

use App\Models\SepetModel;
use App\Models\SepetIcerikModel;
use App\Models\UrunModel;

class SepetController extends BaseController
{
    public function index()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Sepeti görüntülemek için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $sepetModel = new SepetModel();

        $sepet = $sepetModel
            ->where('kullanici_id', $kullaniciId)
            ->first();

        $sepetUrunleri = [];
        $toplam = 0;

        if ($sepet) {
            $db = \Config\Database::connect();

            $sepetUrunleri = $db->table('sepet_icerik')
                ->select('
                    sepet_icerik.id as sepet_icerik_id,
                    sepet_icerik.adet,
                    urunler.id as urun_id,
                    urunler.album_adi,
                    urunler.sanatci,
                    urunler.fiyat,
                    urunler.stok,
                    urunler.resim
                ')
                ->join('urunler', 'urunler.id = sepet_icerik.urun_id')
                ->where('sepet_icerik.sepet_id', $sepet['id'])
                ->get()
                ->getResultArray();

            foreach ($sepetUrunleri as $urun) {
                $toplam += $urun['fiyat'] * $urun['adet'];
            }
        }

        return view('sepet', [
            'sepet_urunleri' => $sepetUrunleri,
            'toplam' => $toplam
        ]);
    }

    public function ekle()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Sepete ürün eklemek için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $urunId = $this->request->getPost('urun_id');
        $adet = (int) $this->request->getPost('adet');

        if ($adet < 1) {
            $adet = 1;
        }

        $urunModel = new UrunModel();
        $urun = $urunModel->find($urunId);

        if (!$urun) {
            return redirect()->back()->with('hata', 'Ürün bulunamadı.');
        }

        if ($urun['stok'] <= 0) {
            return redirect()->back()->with('hata', 'Bu ürün stokta yok.');
        }

        if ($adet > $urun['stok']) {
            $adet = $urun['stok'];
        }

        $sepetModel = new SepetModel();
        $sepetIcerikModel = new SepetIcerikModel();

        $sepet = $sepetModel
            ->where('kullanici_id', $kullaniciId)
            ->first();

        if (!$sepet) {
            $sepetModel->insert([
                'kullanici_id' => $kullaniciId,
                'guncelleme_tarihi' => date('Y-m-d H:i:s')
            ]);

            $sepetId = $sepetModel->insertID();
        } else {
            $sepetId = $sepet['id'];
        }

        $sepettekiUrun = $sepetIcerikModel
            ->where('sepet_id', $sepetId)
            ->where('urun_id', $urunId)
            ->first();

        if ($sepettekiUrun) {
            $yeniAdet = $sepettekiUrun['adet'] + $adet;

            if ($yeniAdet > $urun['stok']) {
                $yeniAdet = $urun['stok'];
            }

            $sepetIcerikModel->update($sepettekiUrun['id'], [
                'adet' => $yeniAdet
            ]);
        } else {
            $sepetIcerikModel->insert([
                'sepet_id' => $sepetId,
                'urun_id' => $urunId,
                'adet' => $adet
            ]);
        }

        $sepetModel->update($sepetId, [
            'guncelleme_tarihi' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/sepet')->with('basari', 'Ürün sepete eklendi.');
    }

    public function guncelle()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login');
        }

        $sepetIcerikId = $this->request->getPost('sepet_icerik_id');
        $adet = (int) $this->request->getPost('adet');

        $sepetIcerikModel = new SepetIcerikModel();

        $sepetIcerik = $sepetIcerikModel->find($sepetIcerikId);

        if (!$sepetIcerik) {
            return redirect()->to('/sepet')->with('hata', 'Sepet ürünü bulunamadı.');
        }

        if ($adet <= 0) {
            $sepetIcerikModel->delete($sepetIcerikId);
        } else {
            $urunModel = new UrunModel();
            $urun = $urunModel->find($sepetIcerik['urun_id']);

            if ($urun && $adet > $urun['stok']) {
                $adet = $urun['stok'];
            }

            $sepetIcerikModel->update($sepetIcerikId, [
                'adet' => $adet
            ]);
        }

        return redirect()->to('/sepet')->with('basari', 'Sepet güncellendi.');
    }

    public function sil($sepetIcerikId)
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login');
        }

        $sepetIcerikModel = new SepetIcerikModel();

        $sepetIcerikModel->delete($sepetIcerikId);

        return redirect()->to('/sepet')->with('basari', 'Ürün sepetten silindi.');
    }

    public function temizle()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login');
        }

        $kullaniciId = session()->get('kullanici_id');

        $sepetModel = new SepetModel();
        $sepetIcerikModel = new SepetIcerikModel();

        $sepet = $sepetModel
            ->where('kullanici_id', $kullaniciId)
            ->first();

        if ($sepet) {
            $sepetIcerikModel
                ->where('sepet_id', $sepet['id'])
                ->delete();
        }

        return redirect()->to('/sepet')->with('basari', 'Sepet temizlendi.');
    }
}