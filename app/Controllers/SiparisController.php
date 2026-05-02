<?php

namespace App\Controllers;

use App\Models\SepetModel;
use App\Models\SepetIcerikModel;
use App\Models\UrunModel;
use App\Models\SiparisModel;
use App\Models\SiparisDetayModel;

class SiparisController extends BaseController
{
    public function odeme()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Ödeme sayfasına geçmek için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $sepetModel = new SepetModel();

        $sepet = $sepetModel
            ->where('kullanici_id', $kullaniciId)
            ->first();

        if (!$sepet) {
            return redirect()->to('/sepet')->with('hata', 'Sepetiniz boş.');
        }

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

        if (empty($sepetUrunleri)) {
            return redirect()->to('/sepet')->with('hata', 'Sepetiniz boş.');
        }

        $toplam = 0;

        foreach ($sepetUrunleri as $urun) {
            $toplam += $urun['fiyat'] * $urun['adet'];
        }

        return view('odeme', [
            'sepet_urunleri' => $sepetUrunleri,
            'toplam' => $toplam
        ]);
    }

    public function tamamla()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Sipariş vermek için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $kargoAdresi = $this->request->getPost('kargo_adresi');
        $odemeYontemi = $this->request->getPost('odeme_yontemi');

        if (empty($kargoAdresi) || empty($odemeYontemi)) {
            return redirect()->back()->with('hata', 'Kargo adresi ve ödeme yöntemi zorunludur.');
        }

        $sepetModel = new SepetModel();
        $sepetIcerikModel = new SepetIcerikModel();
        $urunModel = new UrunModel();
        $siparisModel = new SiparisModel();
        $siparisDetayModel = new SiparisDetayModel();

        $sepet = $sepetModel
            ->where('kullanici_id', $kullaniciId)
            ->first();

        if (!$sepet) {
            return redirect()->to('/sepet')->with('hata', 'Sepetiniz boş.');
        }

        $db = \Config\Database::connect();

        $sepetUrunleri = $db->table('sepet_icerik')
            ->select('
                sepet_icerik.id as sepet_icerik_id,
                sepet_icerik.adet,
                urunler.id as urun_id,
                urunler.album_adi,
                urunler.fiyat,
                urunler.stok
            ')
            ->join('urunler', 'urunler.id = sepet_icerik.urun_id')
            ->where('sepet_icerik.sepet_id', $sepet['id'])
            ->get()
            ->getResultArray();

        if (empty($sepetUrunleri)) {
            return redirect()->to('/sepet')->with('hata', 'Sepetiniz boş.');
        }

        $toplam = 0;

        foreach ($sepetUrunleri as $urun) {
            if ($urun['adet'] > $urun['stok']) {
                return redirect()->to('/sepet')->with('hata', $urun['album_adi'] . ' için yeterli stok yok.');
            }

            $toplam += $urun['fiyat'] * $urun['adet'];
        }

        $db->transStart();

        $siparisModel->insert([
            'kullanici_id' => $kullaniciId,
            'toplam_tutar' => $toplam,
            'kargo_adresi' => $kargoAdresi,
            'odeme_yontemi' => $odemeYontemi,
            'durum' => 'beklemede',
            'tarih' => date('Y-m-d H:i:s')
        ]);

        $siparisId = $siparisModel->insertID();

        foreach ($sepetUrunleri as $urun) {
            $siparisDetayModel->insert([
                'siparis_id' => $siparisId,
                'urun_id' => $urun['urun_id'],
                'adet' => $urun['adet'],
                'birim_fiyat' => $urun['fiyat']
            ]);

            $yeniStok = $urun['stok'] - $urun['adet'];

            $urunModel->update($urun['urun_id'], [
                'stok' => $yeniStok
            ]);
        }

        $sepetIcerikModel
            ->where('sepet_id', $sepet['id'])
            ->delete();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/sepet')->with('hata', 'Sipariş oluşturulurken bir hata oluştu.');
        }

        return redirect()->to('/')->with('basari', 'Siparişiniz başarıyla oluşturuldu.');
    }
}