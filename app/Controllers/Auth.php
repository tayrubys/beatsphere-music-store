<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function loginKontrol()
    {
        $eposta = $this->request->getPost('eposta');
        $sifre = $this->request->getPost('sifre');

        $model = new KullaniciModel();

        $kullanici = $model->where('eposta', $eposta)->first();

        if (!$kullanici) {
            return redirect()->back()->with('hata', 'Bu e-posta ile kayıtlı kullanıcı bulunamadı.');
        }

        if (!password_verify($sifre, $kullanici['sifre'])) {
            return redirect()->back()->with('hata', 'Şifre hatalı.');
        }

        if ($kullanici['durum'] != 'aktif') {
            return redirect()->back()->with('hata', 'Hesabınız aktif değil.');
        }

        session()->set([
            'kullanici_id'  => $kullanici['id'],
            'ad_soyad'      => $kullanici['ad_soyad'],
            'eposta'        => $kullanici['eposta'],
            'rol'           => $kullanici['rol'],
            'giris_yapildi' => true
        ]);

        if ($kullanici['rol'] == 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/');
    }

    public function registerKaydet()
    {
        $model = new KullaniciModel();

        $adSoyad = $this->request->getPost('ad_soyad');
        $eposta  = $this->request->getPost('eposta');
        $telefon = $this->request->getPost('telefon');
        $adres   = $this->request->getPost('adres');
        $sifre   = $this->request->getPost('sifre');

        if (empty($adSoyad) || empty($eposta) || empty($telefon) || empty($adres) || empty($sifre)) {
            return redirect()->back()->with('hata', 'Lütfen tüm alanları doldurun.');
        }

        $varMi = $model->where('eposta', $eposta)->first();

        if ($varMi) {
            return redirect()->back()->with('hata', 'Bu e-posta adresi zaten kayıtlı.');
        }

        $model->insert([
            'ad_soyad' => $adSoyad,
            'eposta'   => $eposta,
            'telefon'  => $telefon,
            'adres'    => $adres,
            'sifre'    => password_hash($sifre, PASSWORD_DEFAULT),
            'rol'      => 'user',
            'bakiye'   => 0,
            'durum'    => 'aktif'
        ]);

        return redirect()->to('/login')->with('basari', 'Kayıt başarılı. Şimdi giriş yapabilirsiniz.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}