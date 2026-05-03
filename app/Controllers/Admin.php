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

        return view('admin/index');
    }

    public function siparisler()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $siparisler = $db->table('siparisler')
            ->select('siparisler.*, kullanicilar.ad_soyad, kullanicilar.eposta')
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

    public function urunler()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $urunler = $db->table('urunler')
            ->select('urunler.*, kategoriler.kategori_adi')
            ->join('kategoriler', 'kategoriler.id = urunler.kategori_id', 'left')
            ->orderBy('urunler.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/urunler', [
            'urunler' => $urunler
        ]);
    }

    public function urunEkle()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $kategoriler = $db->table('kategoriler')
            ->orderBy('kategori_adi', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/urun_form', [
            'baslik' => 'Yeni Ürün Ekle',
            'islem' => 'ekle',
            'urun' => null,
            'kategoriler' => $kategoriler
        ]);
    }

    public function urunKaydet()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $kategoriId = $this->request->getPost('kategori_id');
        $albumAdi = $this->request->getPost('album_adi');
        $sanatci = $this->request->getPost('sanatci');
        $fiyat = $this->request->getPost('fiyat');
        $stok = $this->request->getPost('stok');
        $resim = $this->request->getPost('resim');
        $durum = $this->request->getPost('durum');
        $populer = $this->request->getPost('populer');
        $aciklama = $this->request->getPost('aciklama');

        if (empty($kategoriId) || empty($albumAdi) || empty($sanatci) || empty($fiyat) || $stok === '') {
            return redirect()->back()->with('hata', 'Lütfen zorunlu alanları doldurun.');
        }

        $db = \Config\Database::connect();

        $db->table('urunler')->insert([
            'kategori_id' => $kategoriId,
            'album_adi' => $albumAdi,
            'sanatci' => $sanatci,
            'fiyat' => $fiyat,
            'stok' => $stok,
            'resim' => $resim,
            'durum' => $durum,
            'populer' => $populer,
            'aciklama' => $aciklama
        ]);

        return redirect()->to('/admin/urunler')->with('basari', 'Ürün başarıyla eklendi.');
    }

    public function urunDuzenle($urunId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $urun = $db->table('urunler')
            ->where('id', $urunId)
            ->get()
            ->getRowArray();

        if (!$urun) {
            return redirect()->to('/admin/urunler')->with('hata', 'Ürün bulunamadı.');
        }

        $kategoriler = $db->table('kategoriler')
            ->orderBy('kategori_adi', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/urun_form', [
            'baslik' => 'Ürün Düzenle',
            'islem' => 'duzenle',
            'urun' => $urun,
            'kategoriler' => $kategoriler
        ]);
    }

    public function urunGuncelle($urunId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $kategoriId = $this->request->getPost('kategori_id');
        $albumAdi = $this->request->getPost('album_adi');
        $sanatci = $this->request->getPost('sanatci');
        $fiyat = $this->request->getPost('fiyat');
        $stok = $this->request->getPost('stok');
        $resim = $this->request->getPost('resim');
        $durum = $this->request->getPost('durum');
        $populer = $this->request->getPost('populer');
        $aciklama = $this->request->getPost('aciklama');

        if (empty($kategoriId) || empty($albumAdi) || empty($sanatci) || empty($fiyat) || $stok === '') {
            return redirect()->back()->with('hata', 'Lütfen zorunlu alanları doldurun.');
        }

        $db = \Config\Database::connect();

        $urun = $db->table('urunler')
            ->where('id', $urunId)
            ->get()
            ->getRowArray();

        if (!$urun) {
            return redirect()->to('/admin/urunler')->with('hata', 'Ürün bulunamadı.');
        }

        $db->table('urunler')
            ->where('id', $urunId)
            ->update([
                'kategori_id' => $kategoriId,
                'album_adi' => $albumAdi,
                'sanatci' => $sanatci,
                'fiyat' => $fiyat,
                'stok' => $stok,
                'resim' => $resim,
                'durum' => $durum,
                'populer' => $populer,
                'aciklama' => $aciklama
            ]);

        return redirect()->to('/admin/urunler')->with('basari', 'Ürün başarıyla güncellendi.');
    }

    public function urunSil($urunId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $urun = $db->table('urunler')
            ->where('id', $urunId)
            ->get()
            ->getRowArray();

        if (!$urun) {
            return redirect()->to('/admin/urunler')->with('hata', 'Ürün bulunamadı.');
        }

        $db->table('urunler')
            ->where('id', $urunId)
            ->delete();

        return redirect()->to('/admin/urunler')->with('basari', 'Ürün silindi.');
    }

    public function urunDurumDegistir($urunId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $urun = $db->table('urunler')
            ->where('id', $urunId)
            ->get()
            ->getRowArray();

        if (!$urun) {
            return redirect()->to('/admin/urunler')->with('hata', 'Ürün bulunamadı.');
        }

        $yeniDurum = ($urun['durum'] == 'satista') ? 'kaldirildi' : 'satista';

        $db->table('urunler')
            ->where('id', $urunId)
            ->update([
                'durum' => $yeniDurum
            ]);

        return redirect()->to('/admin/urunler')->with('basari', 'Ürün satış durumu güncellendi.');
    }

    public function urunPopulerDegistir($urunId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $urun = $db->table('urunler')
            ->where('id', $urunId)
            ->get()
            ->getRowArray();

        if (!$urun) {
            return redirect()->to('/admin/urunler')->with('hata', 'Ürün bulunamadı.');
        }

        $yeniPopuler = ($urun['populer'] == 1) ? 0 : 1;

        $db->table('urunler')
            ->where('id', $urunId)
            ->update([
                'populer' => $yeniPopuler
            ]);

        return redirect()->to('/admin/urunler')->with('basari', 'Ürün popüler durumu güncellendi.');
    }

    public function kullanicilar()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $kullanicilar = $db->table('kullanicilar')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/kullanicilar', [
            'kullanicilar' => $kullanicilar
        ]);
    }

public function kullaniciEkle()
{
    $kontrol = $this->adminKontrol();
    if ($kontrol) {
        return $kontrol;
    }

    return view('admin/kullanici_form', [
        'baslik' => 'Yeni Admin Kullanıcısı Ekle',
        'islem' => 'ekle',
        'kullanici' => null
    ]);
}
    public function kullaniciKaydet()
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $adSoyad = $this->request->getPost('ad_soyad');
        $eposta = $this->request->getPost('eposta');
        $telefon = $this->request->getPost('telefon');
        $adres = $this->request->getPost('adres');
        $sifre = $this->request->getPost('sifre');

        if (empty($adSoyad) || empty($eposta) || empty($telefon) || empty($adres) || empty($sifre)) {
            return redirect()->back()->with('hata', 'Lütfen tüm alanları doldurun.');
        }

        if (strlen($sifre) < 6) {
            return redirect()->back()->with('hata', 'Şifre en az 6 karakter olmalıdır.');
        }

        $db = \Config\Database::connect();

        $varMi = $db->table('kullanicilar')
            ->where('eposta', $eposta)
            ->get()
            ->getRowArray();

        if ($varMi) {
            return redirect()->back()->with('hata', 'Bu e-posta adresi zaten kullanılıyor.');
        }

        $db->table('kullanicilar')->insert([
            'ad_soyad' => $adSoyad,
            'eposta' => $eposta,
            'telefon' => $telefon,
            'adres' => $adres,
            'sifre' => password_hash($sifre, PASSWORD_DEFAULT),
            'rol' => 'admin',
            'bakiye' => 0,
            'durum' => 'aktif'
        ]);

        return redirect()->to('/admin/kullanicilar')->with('basari', 'Yeni admin kullanıcısı başarıyla eklendi.');
    }

    public function kullaniciDuzenle($kullaniciId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $db = \Config\Database::connect();

        $kullanici = $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->get()
            ->getRowArray();

        if (!$kullanici) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kullanıcı bulunamadı.');
        }

        return view('admin/kullanici_form', [
            'baslik' => 'Kullanıcı Düzenle',
            'islem' => 'duzenle',
            'kullanici' => $kullanici
        ]);
    }

    public function kullaniciGuncelle($kullaniciId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        $adSoyad = $this->request->getPost('ad_soyad');
        $eposta = $this->request->getPost('eposta');
        $telefon = $this->request->getPost('telefon');
        $adres = $this->request->getPost('adres');
        $rol = $this->request->getPost('rol');
        $durum = $this->request->getPost('durum');
        $bakiye = $this->request->getPost('bakiye');

        if (empty($adSoyad) || empty($eposta) || empty($telefon) || empty($adres) || empty($rol) || empty($durum)) {
            return redirect()->back()->with('hata', 'Lütfen tüm alanları doldurun.');
        }

        $db = \Config\Database::connect();

        $kullanici = $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->get()
            ->getRowArray();

        if (!$kullanici) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kullanıcı bulunamadı.');
        }

        $varMi = $db->table('kullanicilar')
            ->where('eposta', $eposta)
            ->where('id !=', $kullaniciId)
            ->get()
            ->getRowArray();

        if ($varMi) {
            return redirect()->back()->with('hata', 'Bu e-posta başka bir kullanıcı tarafından kullanılıyor.');
        }

        $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->update([
                'ad_soyad' => $adSoyad,
                'eposta' => $eposta,
                'telefon' => $telefon,
                'adres' => $adres,
                'rol' => $rol,
                'durum' => $durum,
                'bakiye' => $bakiye
            ]);

        return redirect()->to('/admin/kullanicilar')->with('basari', 'Kullanıcı bilgileri güncellendi.');
    }

    public function kullaniciDurumDegistir($kullaniciId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        if ($kullaniciId == session()->get('kullanici_id')) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kendi hesabınızın durumunu buradan değiştiremezsiniz.');
        }

        $db = \Config\Database::connect();

        $kullanici = $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->get()
            ->getRowArray();

        if (!$kullanici) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kullanıcı bulunamadı.');
        }

        $yeniDurum = ($kullanici['durum'] == 'aktif') ? 'pasif' : 'aktif';

        $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->update([
                'durum' => $yeniDurum
            ]);

        return redirect()->to('/admin/kullanicilar')->with('basari', 'Kullanıcı durumu güncellendi.');
    }

    public function kullaniciSil($kullaniciId)
    {
        $kontrol = $this->adminKontrol();
        if ($kontrol) {
            return $kontrol;
        }

        if ($kullaniciId == session()->get('kullanici_id')) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kendi hesabınızı silemezsiniz.');
        }

        $db = \Config\Database::connect();

        $kullanici = $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->get()
            ->getRowArray();

        if (!$kullanici) {
            return redirect()->to('/admin/kullanicilar')->with('hata', 'Kullanıcı bulunamadı.');
        }

        $db->table('kullanicilar')
            ->where('id', $kullaniciId)
            ->delete();

        return redirect()->to('/admin/kullanicilar')->with('basari', 'Kullanıcı silindi.');
    }
}