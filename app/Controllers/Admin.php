<?php

namespace App\Controllers;

class Admin extends BaseController
{
    private function adminKontrol()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Admin paneline giriş yapmak için oturum açmalısınız.');
        }

        if (session()->get('rol') != 'admin') {
            return redirect()->to('/')->with('hata', 'Bu sayfaya erişim yetkiniz yok.');
        }

        return null;
    }

    public function index()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        return redirect()->to('/admin/siparisler');
    }

    public function siparisler()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $siparisler = $db->table('siparisler')
            ->select('
                siparisler.*,
                kullanicilar.ad_soyad,
                kullanicilar.eposta
            ')
            ->join('kullanicilar', 'kullanicilar.id = siparisler.kullanici_id')
            ->orderBy('siparisler.tarih', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/siparisler', [
            'siparisler' => $siparisler
        ]);
    }

    public function siparisOnayla($siparisId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $siparis = $db->table('siparisler')
            ->where('id', $siparisId)
            ->get()
            ->getRowArray();

        if (!$siparis) {
            return redirect()->to('/admin/siparisler')->with('hata', 'Sipariş bulunamadı.');
        }

        if ($siparis['durum'] != 'beklemede') {
            return redirect()->to('/admin/siparisler')->with('hata', 'Sadece beklemede olan siparişler onaylanabilir.');
        }

        $db->table('siparisler')
            ->where('id', $siparisId)
            ->update([
                'durum' => 'onaylandi',
                'siparis_asamasi' => 'tedarik_ediliyor'
            ]);

        return redirect()->to('/admin/siparisler')->with('basari', 'Sipariş onaylandı ve tedarik aşamasına alındı.');
    }

    public function siparisAsamaIlerlet($siparisId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $siparis = $db->table('siparisler')
            ->where('id', $siparisId)
            ->get()
            ->getRowArray();

        if (!$siparis) {
            return redirect()->to('/admin/siparisler')->with('hata', 'Sipariş bulunamadı.');
        }

        if ($siparis['durum'] != 'onaylandi') {
            return redirect()->to('/admin/siparisler')->with('hata', 'Sadece onaylanmış siparişlerin aşaması ilerletilebilir.');
        }

        $mevcutAsama = $siparis['siparis_asamasi'];

        $sonrakiAsama = null;

        if ($mevcutAsama == 'tedarik_ediliyor') {
            $sonrakiAsama = 'kutulaniyor';
        } elseif ($mevcutAsama == 'kutulaniyor') {
            $sonrakiAsama = 'kargoya_verildi';
        } elseif ($mevcutAsama == 'kargoya_verildi') {
            $sonrakiAsama = 'yolda';
        } elseif ($mevcutAsama == 'yolda') {
            $sonrakiAsama = 'teslim_edildi';
        } else {
            return redirect()->to('/admin/siparisler')->with('hata', 'Bu sipariş daha fazla ilerletilemez.');
        }

        $guncelleme = [
            'siparis_asamasi' => $sonrakiAsama
        ];

        if ($sonrakiAsama == 'teslim_edildi') {
            $guncelleme['durum'] = 'teslim_edildi';
        }

        $db->table('siparisler')
            ->where('id', $siparisId)
            ->update($guncelleme);

        return redirect()->to('/admin/siparisler')->with('basari', 'Sipariş aşaması güncellendi.');
    }
}