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







