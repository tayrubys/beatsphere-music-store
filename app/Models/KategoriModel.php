<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategoriler';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori_adi'];
}