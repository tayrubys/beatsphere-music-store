<?php 

namespace App\Models;
use CodeIgniter\Model;

class UrunModel extends Model
{
    // Hangi tabloya bağlanacağını söylüyoruz
    protected $table = 'urunler';
    
    // Tablonun anahtar (ID) sütunu
    protected $primaryKey = 'id';
    
    // Kod üzerinden hangi sütunlara veri ekleyip silebileceğimize izin veriyoruz
    protected $allowedFields = ['kategori_id', 'album_adi', 'sanatci', 'fiyat', 'stok', 'resim', 'durum','populer'];
    public function kategoriyeGoreUrunler($kategori_id){
        return $this->where('kategori_id', $kategori_id)
                    ->where('durum', 'satista')
                    ->findAll();
    }
}