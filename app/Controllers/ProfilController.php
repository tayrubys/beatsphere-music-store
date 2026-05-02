<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class ProfilController extends BaseController
{
    public function profilGuncelle()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Bu işlem için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $adSoyad = $this->request->getPost('ad_soyad');
        $eposta = $this->request->getPost('eposta');
        $telefon = $this->request->getPost('telefon');
        $adres = $this->request->getPost('adres');

        if (empty($adSoyad) || empty($eposta) || empty($telefon) || empty($adres)) {
            return redirect()->to('/profil')->with('hata', 'Lütfen tüm alanları doldurun.');
        }

        $model = new KullaniciModel();

        $varMi = $model
            ->where('eposta', $eposta)
            ->where('id !=', $kullaniciId)
            ->first();

        if ($varMi) {
            return redirect()->to('/profil')->with('hata', 'Bu e-posta adresi başka bir kullanıcı tarafından kullanılıyor.');
        }

        $model->update($kullaniciId, [
            'ad_soyad' => $adSoyad,
            'eposta' => $eposta,
            'telefon' => $telefon,
            'adres' => $adres
        ]);

        session()->set([
            'ad_soyad' => $adSoyad,
            'eposta' => $eposta
        ]);

        return redirect()->to('/profil')->with('basari', 'Profil bilgileriniz güncellendi.');
    }

    public function sifreGuncelle()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login')->with('hata', 'Bu işlem için giriş yapmalısınız.');
        }

        $kullaniciId = session()->get('kullanici_id');

        $mevcutSifre = $this->request->getPost('mevcut_sifre');
        $yeniSifre = $this->request->getPost('yeni_sifre');
        $yeniSifreTekrar = $this->request->getPost('yeni_sifre_tekrar');

        if (empty($mevcutSifre) || empty($yeniSifre) || empty($yeniSifreTekrar)) {
            return redirect()->to('/profil')->with('hata', 'Lütfen tüm şifre alanlarını doldurun.');
        }

        if ($yeniSifre != $yeniSifreTekrar) {
            return redirect()->to('/profil')->with('hata', 'Yeni şifreler eşleşmiyor.');
        }

        if (strlen($yeniSifre) < 6) {
            return redirect()->to('/profil')->with('hata', 'Yeni şifre en az 6 karakter olmalıdır.');
        }

        $model = new KullaniciModel();

        $kullanici = $model->find($kullaniciId);

        if (!$kullanici) {
            return redirect()->to('/login')->with('hata', 'Kullanıcı bulunamadı.');
        }

        if (!password_verify($mevcutSifre, $kullanici['sifre'])) {
            return redirect()->to('/profil')->with('hata', 'Mevcut şifreniz hatalı.');
        }

        $model->update($kullaniciId, [
            'sifre' => password_hash($yeniSifre, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/profil')->with('basari', 'Şifreniz başarıyla güncellendi.');
    }
}