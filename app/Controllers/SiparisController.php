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

     // Kullanıcının bakiyesini çek
     $kullanici = $db->table('kullanicilar')
         ->where('id', $kullaniciId)
         ->get()
         ->getRowArray();

     return view('odeme', [
         'sepet_urunleri' => $sepetUrunleri,
         'toplam' => $toplam,
         'kullanici' => $kullanici
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

    // Kullanıcının mevcut bakiyesini al
    $kullanici = $db->table('kullanicilar')
        ->where('id', $kullaniciId)
        ->get()
        ->getRowArray();

    $mevcutBakiye = $kullanici['bakiye'];

    // Siparişte ne kadar bakiye kullanılacağını hesapla
    if ($mevcutBakiye >= $toplam) {
        $bakiyeKullanilan = $toplam;
        $karttanOdenen = 0;
        $yeniBakiye = $mevcutBakiye - $toplam;
    } else {
        $bakiyeKullanilan = $mevcutBakiye;
        $karttanOdenen = $toplam - $mevcutBakiye;
        $yeniBakiye = 0;
    }

    $db->transStart();

    // Siparişi oluştur
    $siparisModel->insert([
        'kullanici_id' => $kullaniciId,
        'toplam_tutar' => $toplam,
        'kargo_adresi' => $kargoAdresi,
        'odeme_yontemi' => $odemeYontemi,
        'durum' => 'beklemede',
        'tarih' => date('Y-m-d H:i:s'),
        'bakiye_kullanilan' => $bakiyeKullanilan,
        'karttan_odenen' => $karttanOdenen
    ]);

    $siparisId = $siparisModel->insertID();

    // Sipariş detaylarını ekle ve stokları azalt
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

    // Kullanıcının bakiyesini güncelle
    $db->table('kullanicilar')
        ->where('id', $kullaniciId)
        ->update([
            'bakiye' => $yeniBakiye
        ]);

    // Sepeti temizle
    $sepetIcerikModel
        ->where('sepet_id', $sepet['id'])
        ->delete();

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->to('/sepet')->with('hata', 'Sipariş oluşturulurken bir hata oluştu.');
    }

    return redirect()->to('/')->with('basari', 'Siparişiniz başarıyla oluşturuldu. Cüzdan bakiyeniz kullanıldı.');
}

 public function detay($siparisId)
  {
    if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login')->with('hata', 'Sipariş detayını görüntülemek için giriş yapmalısınız.');
    }

    $kullaniciId = session()->get('kullanici_id');

    $db = \Config\Database::connect();

    // Sipariş gerçekten bu kullanıcıya mı ait?
    $siparis = $db->table('siparisler')
        ->where('id', $siparisId)
        ->where('kullanici_id', $kullaniciId)
        ->get()
        ->getRowArray();

    if (!$siparis) {
        return redirect()->to('/profil')->with('hata', 'Sipariş bulunamadı.');
    }

    // Sipariş içindeki ürünleri getir
    $siparisUrunleri = $db->table('siparis_detaylari')
        ->select('
            siparis_detaylari.adet,
            siparis_detaylari.birim_fiyat,
            urunler.album_adi,
            urunler.sanatci,
            urunler.resim
        ')
        ->join('urunler', 'urunler.id = siparis_detaylari.urun_id')
        ->where('siparis_detaylari.siparis_id', $siparisId)
        ->get()
        ->getResultArray();

    return view('siparis_detay', [
        'siparis' => $siparis,
        'siparis_urunleri' => $siparisUrunleri
    ]);
  }

public function iptal($siparisId)
{
    if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login')->with('hata', 'Sipariş iptal etmek için giriş yapmalısınız.');
    }

    $kullaniciId = session()->get('kullanici_id');

    $db = \Config\Database::connect();

    // Siparişi bul
    $siparis = $db->table('siparisler')
        ->where('id', $siparisId)
        ->where('kullanici_id', $kullaniciId)
        ->get()
        ->getRowArray();

    if (!$siparis) {
        return redirect()->to('/profil')->with('hata', 'Sipariş bulunamadı.');
    }

    // Sadece beklemede olan sipariş iptal edilsin
    if ($siparis['durum'] != 'beklemede') {
        return redirect()->to('siparis-detay/' . $siparisId)
            ->with('hata', 'Sadece beklemede olan siparişler iptal edilebilir.');
    }

    // Siparişteki ürünleri al
    $siparisUrunleri = $db->table('siparis_detaylari')
        ->where('siparis_id', $siparisId)
        ->get()
        ->getResultArray();

    $db->transStart();

    // Ürün stoklarını geri ekle
    foreach ($siparisUrunleri as $urun) {
        $mevcutUrun = $db->table('urunler')
            ->where('id', $urun['urun_id'])
            ->get()
            ->getRowArray();

        if ($mevcutUrun) {
            $yeniStok = $mevcutUrun['stok'] + $urun['adet'];

            $db->table('urunler')
                ->where('id', $urun['urun_id'])
                ->update([
                    'stok' => $yeniStok
                ]);
        }
    }

    // Sipariş durumunu iptal yap
    $db->table('siparisler')
        ->where('id', $siparisId)
        ->where('kullanici_id', $kullaniciId)
        ->update([
            'durum' => 'iptal'
        ]);

    // Sipariş toplam tutarını kullanıcının bakiyesine ekle
    $db->table('kullanicilar')
        ->where('id', $kullaniciId)
        ->set('bakiye', 'bakiye + ' . $siparis['toplam_tutar'], false)
        ->update();

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->to('siparis-detay/' . $siparisId)
            ->with('hata', 'Sipariş iptal edilirken bir hata oluştu.');
    }

    return redirect()->to('siparis-detay/' . $siparisId)
        ->with('basari', 'Sipariş iptal edildi. Ürün stokları geri eklendi ve ücret cüzdanınıza aktarıldı.');
}
}