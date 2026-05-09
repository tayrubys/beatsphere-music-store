<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//anasayfa
$routes->get('/', 'Home::index');
$routes->get('hakkimizda', 'Home::hakkimizda');
$routes->get('anasayfa','Home::anasayfa');
$routes->get('iletisim','Home::iletisim');
$routes->post('iletisim-gonder', 'Home::iletisimGonder');
$routes->get('/admin/mesajlar', 'Admin::mesajlar');
$routes->get('/admin/mesaj-okundu/(:num)', 'Admin::mesajOkundu/$1');
$routes->get('/admin/mesaj-sil/(:num)', 'Admin::mesajSil/$1');
$routes->get('kargo_takip','Home::kargo_takip');

//kullanıcı işlemleri
$routes->get('register', 'Home::register');
$routes->post('register-kaydet', 'Auth::registerKaydet');
$routes->get('profil','Home::profil');
$routes->get('/login', 'Auth::login');
$routes->post('/login-kontrol', 'Auth::loginKontrol');
$routes->get('/logout', 'Auth::logout');
$routes->post('profil-guncelle', 'ProfilController::profilGuncelle');
$routes->post('sifre-guncelle', 'ProfilController::sifreGuncelle');
$routes->post('hesap-dondur', 'ProfilController::hesapDondur');

//admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/siparisler', 'Admin::siparisler');
$routes->get('/admin/siparis-onayla/(:num)', 'Admin::siparisOnayla/$1');
$routes->get('/admin/siparis-asama-ilerlet/(:num)', 'Admin::siparisAsamaIlerlet/$1');
//admin ürün yönetimi
$routes->get('/admin/urunler', 'Admin::urunler');
$routes->get('/admin/urun-sil/(:num)', 'Admin::urunSil/$1');
$routes->get('/admin/urun-durum-degistir/(:num)', 'Admin::urunDurumDegistir/$1');
$routes->get('/admin/urun-populer-degistir/(:num)', 'Admin::urunPopulerDegistir/$1');
$routes->get('/admin/urun-ekle', 'Admin::urunEkle');
$routes->post('/admin/urun-kaydet', 'Admin::urunKaydet');
$routes->get('/admin/urun-duzenle/(:num)', 'Admin::urunDuzenle/$1');
$routes->post('/admin/urun-guncelle/(:num)', 'Admin::urunGuncelle/$1');
$routes->get('/admin/urun-resim-sil/(:num)', 'Admin::urunResimSil/$1');
//admin kullanıcı yönetimi
$routes->get('/admin/kullanicilar', 'Admin::kullanicilar');
$routes->get('/admin/kullanici-ekle', 'Admin::kullaniciEkle');
$routes->post('/admin/kullanici-kaydet', 'Admin::kullaniciKaydet');
$routes->get('/admin/kullanici-duzenle/(:num)', 'Admin::kullaniciDuzenle/$1');
$routes->post('/admin/kullanici-guncelle/(:num)', 'Admin::kullaniciGuncelle/$1');
$routes->get('/admin/kullanici-durum-degistir/(:num)', 'Admin::kullaniciDurumDegistir/$1');
$routes->get('/admin/kullanici-sil/(:num)', 'Admin::kullaniciSil/$1');
//admin kendi yonetımı
$routes->get('/admin/profil', 'Admin::profilGoruntule');
$routes->post('/admin/sifre-guncelle', 'Admin::sifreGuncelle');
$routes->post('/admin/profil-guncelle', 'Admin::profilGuncelle');

//urun ve kategori
$routes->get('/kategori/(:num)', 'UrunController::kategori/$1');
$routes->get('/urun/(:num)', 'UrunController::detay/$1');

//sepet
$routes->get('sepet', 'SepetController::index');
$routes->post('sepete-ekle', 'SepetController::ekle');
$routes->post('sepet-guncelle', 'SepetController::guncelle');
$routes->get('sepet-sil/(:num)', 'SepetController::sil/$1');
$routes->get('sepet-temizle', 'SepetController::temizle');

//odeme
//$routes->get('odeme','Home::odeme');
$routes->get('odeme', 'SiparisController::odeme');
$routes->post('siparis-tamamla', 'SiparisController::tamamla');

//sipariş detay
$routes->get('siparis-detay/(:num)', 'SiparisController::detay/$1');
$routes->get('siparis-iptal/(:num)', 'SiparisController::iptal/$1');
$routes->get('siparis-teslim-aldim/(:num)', 'SiparisController::teslimAldim/$1');
$routes->get('siparis-fatura/(:num)', 'SiparisController::fatura/$1');






