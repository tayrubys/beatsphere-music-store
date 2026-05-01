<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table = 'kullanicilar';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'ad_soyad',
        'eposta',
        'telefon',
        'sifre',
        'rol',
        'adres',
        'bakiye',
        'durum'
    ];
}