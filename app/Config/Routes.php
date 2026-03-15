<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('hakkimizda', 'Home::hakkimizda');
$routes->get('login', 'Home::login');
$routes->get('register', 'Home::register');
$routes->get('profil','Home::profil');
$routes->get('sepet','Home::sepet');
$routes->get('odeme','Home::odeme');
$routes->get('anasayfa','Home::anasayfa');
$routes->get('kargo_takip','Home::kargo_takip');
$routes->get('iletisim','Home::iletisim');