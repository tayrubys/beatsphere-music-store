<?php

namespace App\Controllers;
use App\Models\UrunModel; // Az önce yazdığımız garsonu (Model) çağırıyoruz

class Home extends BaseController
{
    public function index()
    {
        $urunModel = new UrunModel();

    $veri['urunler'] = $urunModel
        ->where('durum', 'satista')
        ->where('populer', 1)
        ->findAll();

    return view('anasayfa', $veri);
    }
    public function hakkimizda()
    {
        return view('hakkimizda');
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
   public function profil()
   {
    if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login')->with('hata', 'Profil sayfasını görüntülemek için giriş yapmalısınız.');
    }

    $kullaniciId = session()->get('kullanici_id');

    $db = \Config\Database::connect();

    $siparisler = $db->table('siparisler')
        ->where('kullanici_id', $kullaniciId)
        ->orderBy('tarih', 'DESC')
        ->get()
        ->getResultArray();
      $kullanici = $db->table('kullanicilar')
    ->where('id', $kullaniciId)
    ->get()
    ->getRowArray();
  return view('profil', [
    'siparisler' => $siparisler,
    'kullanici' => $kullanici
]);
   }
    public function sepet()
    {
      if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login');
      }
        return view('sepet');
    }
    public function odeme(){
      if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login');
      }
        return view('odeme');
    }
   /* public function anasayfa()
    {
      $urunModel = new \App\Models\UrunModel();

      $data['urunler'] = $urunModel
        ->where('durum', 'satista')
        ->where('populer', 1)
        ->limit(12)
        ->findAll();

      return view('anasayfa', $data);
    }*/
    public function kargo_takip(){
      if (!session()->get('giris_yapildi')) {
        return redirect()->to('/login');
      }
        return view('kargo_takip');
    }
     public function iletisim(){
        return view('iletisim');
    }
        public function iletisimGonder(){
        $mesajModel = new \App\Models\MesajModel();
 
        $adSoyad = trim($this->request->getPost('name'));
        $eposta  = trim($this->request->getPost('email'));
        $konu    = trim($this->request->getPost('subject'));
        $mesaj   = trim($this->request->getPost('message'));
 
        if (empty($adSoyad) || empty($eposta) || empty($konu) || empty($mesaj)) {
            return redirect()->to('/iletisim')->with('hata', 'Lütfen tüm alanları doldurunuz.');
        }
 
        if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/iletisim')->with('hata', 'Geçerli bir e-posta adresi giriniz.');
        }
 
        $mesajModel->insert([
            'ad_soyad' => $adSoyad,
            'eposta'   => $eposta,
            'konu'     => $konu,
            'mesaj'    => $mesaj,
            'okundu'   => 0,
        ]);
 
        return redirect()->to('/iletisim')->with('basari', 'Mesajınız başarıyla gönderildi. En kısa sürede dönüş yapacağız!');
    }
    public function kategori($kategori_id){
       $urunModel = new \App\Models\UrunModel();

       $data['urunler'] = $urunModel
        ->where('durum', 'satista')
        ->where('kategori_id', $kategori_id)
        ->findAll();

     return view('kategori_urunleri', $data);
    }
}
