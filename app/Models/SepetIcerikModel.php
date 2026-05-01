<?php

namespace App\Models;

use CodeIgniter\Model;

class SepetIcerikModel extends Model
{
    protected $table = 'sepet_icerik';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'sepet_id',
        'urun_id',
        'adet'
    ];
}