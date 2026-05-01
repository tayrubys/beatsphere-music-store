<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('hakkimizda', 'Home::hakkimizda');
$routes->get('register', 'Home::register');
$routes->get('profil','Home::profil');
//$routes->get('sepet','Home::sepet');
$routes->get('odeme','Home::odeme');
$routes->get('anasayfa','Home::anasayfa');
$routes->get('kargo_takip','Home::kargo_takip');
$routes->get('iletisim','Home::iletisim');
$routes->get('/login', 'Auth::login');
$routes->post('/login-kontrol', 'Auth::loginKontrol');
$routes->get('/logout', 'Auth::logout');
$routes->get('/admin', 'Admin::index');
$routes->get('/kategori/(:num)', 'UrunController::kategori/$1');
$routes->get('/urun/(:num)', 'UrunController::detay/$1');
$routes->get('sepet', 'SepetController::index');
$routes->post('sepete-ekle', 'SepetController::ekle');
$routes->post('sepet-guncelle', 'SepetController::guncelle');
$routes->get('sepet-sil/(:num)', 'SepetController::sil/$1');
$routes->get('sepet-temizle', 'SepetController::temizle');