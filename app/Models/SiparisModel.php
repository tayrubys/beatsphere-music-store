<?php

namespace App\Models;

use CodeIgniter\Model;

class SiparisModel extends Model
{
    protected $table = 'siparisler';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kullanici_id',
        'toplam_tutar',
        'kargo_adresi',
        'odeme_yontemi',
        'durum',
        'tarih',
        'bakiye_kullanilan',
        'karttan_odenen'
    ];
}