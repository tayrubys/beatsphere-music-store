<?php

namespace App\Controllers;
use App\Models\UrunModel; // Az önce yazdığımız garsonu (Model) çağırıyoruz

class Home extends BaseController
{
    public function index()
    {
        // 1. Modelimizi çalıştırıyoruz
        $urunModel = new UrunModel();
        
        // 2. Veritabanındaki tüm ürünleri çekip 'urunler' adında bir pakete koyuyoruz
        $veri['urunler'] = $urunModel->findAll();
        
        // 3. Bu paketi 'anasayfa' isimli tasarıma (View) gönderiyoruz
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
    public function profil(){
        return view('profil');
    }
    public function sepet()
    {
        return view('sepet');
    }
    public function odeme(){
        return view('odeme');
    }
    public function anasayfa(){
        return view('anasayfa');
    }
    public function kargo_takip(){
        return view('kargo_takip');
    }
     public function iletisim(){
        return view('iletisim');
    }

}
