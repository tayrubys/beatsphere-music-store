<?php

namespace App\Models;

use CodeIgniter\Model;

class SiparisDetayModel extends Model
{
    protected $table = 'siparis_detaylari';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'siparis_id',
        'urun_id',
        'adet',
        'birim_fiyat'
    ];
}