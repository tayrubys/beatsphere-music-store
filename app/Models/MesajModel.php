<?php
 
namespace App\Models;
use CodeIgniter\Model;
 
class MesajModel extends Model
{
    protected $table      = 'mesajlar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ad_soyad', 'eposta', 'konu', 'mesaj', 'okundu'];
    protected $useTimestamps = true;
    protected $createdField  = 'tarih';
    protected $updatedField  = '';
}