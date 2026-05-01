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
        $eposta = $this->request->getPost('eposta'); //epostayı alıyor
        $sifre = $this->request->getPost('sifre');

        $model = new KullaniciModel();

        $kullanici = $model->where('eposta', $eposta)->first();//veritabanında kullanıcıyı arıyozu

        if (!$kullanici) {
            return redirect()->back()->with('hata', 'Bu e-posta ile kayıtlı kullanıcı bulunamadı.');
        }

        if (!password_verify($sifre, $kullanici['sifre'])) {//hashli sifreyi kontrol ediyoruz
            return redirect()->back()->with('hata', 'Şifre hatalı.');
        }

        if ($kullanici['durum'] != 'aktif') {
            return redirect()->back()->with('hata', 'Hesabınız aktif değil.');
        }

        //giris bilgisini hafizaya aliyroz
        session()->set([
            'kullanici_id' => $kullanici['id'],
            'ad_soyad'     => $kullanici['ad_soyad'],
            'eposta'       => $kullanici['eposta'],
            'rol'          => $kullanici['rol'],
            'giris_yapildi'=> true
        ]);

        if ($kullanici['rol'] == 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}