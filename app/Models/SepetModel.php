<?php

namespace App\Models;

use CodeIgniter\Model;

class SepetModel extends Model
{
    protected $table = 'sepetler';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kullanici_id',
        'guncelleme_tarihi'
    ];
}