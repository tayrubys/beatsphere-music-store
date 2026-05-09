#  BeatSphere
<div align="center">
 
![CodeIgniter](https://img.shields.io/badge/CODEIGNITER-4-3498DB?style=for-the-badge&logo=codeigniter&logoColor=white&labelColor=141E30)
![PHP](https://img.shields.io/badge/PHP-BACKEND-3498DB?style=for-the-badge&logo=php&logoColor=white&labelColor=0d1b2f)
![MySQL](https://img.shields.io/badge/MYSQL-DATABASE-3498DB?style=for-the-badge&logo=mysql&logoColor=white&labelColor=141E30)
![HTML](https://img.shields.io/badge/HTML-PAGE-3498DB?style=for-the-badge&logo=html5&logoColor=white&labelColor=0d1b2f)
![CSS](https://img.shields.io/badge/CSS-STYLING-3498DB?style=for-the-badge&logo=css3&logoColor=white&labelColor=141E30)
![Bootstrap](https://img.shields.io/badge/BOOTSTRAP-UI-3498DB?style=for-the-badge&logo=bootstrap&logoColor=white&labelColor=0d1b2f)
![Auth](https://img.shields.io/badge/AUTH-LOGIN_SYSTEM-3498DB?style=for-the-badge&logo=auth0&logoColor=white&labelColor=141E30)
![Admin](https://img.shields.io/badge/ADMIN-PANEL-3498DB?style=for-the-badge&logo=securityscorecard&logoColor=white&labelColor=0d1b2f)
 
**BeatSphere**, müzik albümü satışına yönelik geliştirilmiş bir e-ticaret web uygulamasıdır. Kullanıcılar albümleri inceleyip satın alabilir; yöneticiler ürün, kullanıcı ve sipariş yönetimini tek panelden gerçekleştirebilir.
 
</div>
 
---
 
##  Teknolojiler
 
| Katman | Teknoloji |
|--------|-----------|
| Backend Framework | PHP — CodeIgniter 4 |
| Veritabanı | MySQL (MySQLi sürücüsü) |
| Frontend | HTML, CSS, Bootstrap, JavaScript |
| Sunucu | Apache (XAMPP / WAMP) |
| Oturum Yönetimi | CodeIgniter Session (dosya tabanlı) |
 
---
 
##  Proje Yapısı
 
```
BeatSphere/
├── app/
│   ├── Config/          # Uygulama ayarları (veritabanı, rotalar, güvenlik…)
│   ├── Controllers/     # İş mantığı katmanı
│   │   ├── Home.php           # Anasayfa, profil, statik sayfalar
│   │   ├── Auth.php           # Kayıt / giriş / çıkış
│   │   ├── Admin.php          # Yönetici paneli
│   │   ├── UrunController.php # Ürün listeleme & detay
│   │   ├── SepetController.php# Sepet işlemleri
│   │   ├── SiparisController.php # Ödeme & sipariş
│   │   └── ProfilController.php  # Profil güncelleme
│   ├── Models/          # Veritabanı modelleri
│   │   ├── UrunModel.php
│   │   ├── KullaniciModel.php
│   │   ├── SepetModel.php
│   │   ├── SepetIcerikModel.php
│   │   ├── SiparisModel.php
│   │   └── SiparisDetayModel.php
│   └── Views/           # Arayüz şablonları
│       ├── anasayfa.php
│       ├── sepet.php
│       ├── odeme.php
│       ├── profil.php
│       └── admin/       # Yönetici paneli görünümleri
├── public/
│   ├── assets/          # CSS, JS, görseller
│   └── uploads/         # Yüklenen ürün resimleri
├── writable/            # Cache, log, session dosyaları
└── .env                 # Ortam değişkenleri
```
 
---
##  Diyagramlar
 
### Akış Diyagramı
 
```mermaid
flowchart TD
    A([Ziyaretçi]) --> B{Giriş yapıldı mı?}
 
    B -- Hayır --> C[Giriş / Kayıt Sayfası]
    C --> D[Kimlik Doğrula]
    D -- Hatalı --> E[Hata Mesajı]
    D -- Başarılı --> B
 
    B -- Admin --> AP[Admin Paneli]
    AP --> AP1[Ürün Yönetimi\nekle / düzenle / sil]
    AP --> AP2[Kullanıcı Yönetimi\nekle / düzenle / durum]
    AP --> AP3[Sipariş Yönetimi]
    AP --> AP4[Mesaj Yönetimi\nokundu işaretle / sil]
    AP3 --> SO[Sipariş Onayla]
    SO --> SA[Aşama İlerlet\ntedarik → kargoda → teslim edildi]
 
    B -- Kullanıcı --> F[Anasayfa\nPopüler albümler]
    F --> G[Kategori\nÜrünler filtrelenir]
    F --> H[Ürün Detay\nAlbüm bilgisi + adet]
    F --> PR[Profil\nBilgi + siparişler]
    F --> IL[İletişim Formu\nad / e-posta / konu / mesaj]
    PR --> PR1[Bilgi / Şifre Güncelle\nHesap Dondur]
    IL --> IL1[Mesaj Gönderildi\nDB'ye kaydedilir]
    IL1 --> AP4
 
    H --> I[Sepet\nekle / güncelle / sil]
    I -- Sepet boş --> ERR1[Hata Yönlendirme]
    I --> J[Ödeme Sayfası\nKargo adresi + yöntem]
    J --> K[Sipariş Tamamla\nStok düş · Bakiye güncelle · Sepeti temizle]
    K -- Transaction hatası --> ERR2[Rollback]
    K --> L[Sipariş Beklemede]
 
    L -- Kullanıcı --> IPS[İptal Et\nStok + bakiye iade]
    SA --> TES[Teslim Alındı\nKullanıcı teyit eder]
    TES --> FAT[Fatura Görüntüle]
```
 
---
 
### Varlık-İlişki (ER) Diyagramı

 ```mermaid
erDiagram
    kategoriler ||--o{ urunler : "1'den çoğa (Bir kategori birden fazla ürüne sahip olabilir)"
    kullanicilar ||--o{ sepetler : "1'den çoğa (Bir kullanıcının sepet(ler)i olabilir)"
    kullanicilar ||--o{ siparisler : "1'den çoğa (Bir kullanıcı birden fazla sipariş verebilir)"
    sepetler ||--o{ sepet_icerik : "1'den çoğa (Bir sepet birden fazla ürün içerebilir)"
    urunler ||--o{ sepet_icerik : "1'den çoğa (Bir ürün birden fazla sepette yer alabilir)"
    siparisler ||--o{ siparis_detaylari : "1'den çoğa (Bir siparişin birden fazla detayı/ürünü olabilir)"
    urunler ||--o{ siparis_detaylari : "1'den çoğa (Bir ürün birden fazla siparişte yer alabilir)"

    kategoriler {
        int id PK
        varchar kategori_adi
    }

    kullanicilar {
        int id PK
        varchar ad_soyad
        varchar eposta
        varchar telefon
        varchar sifre
        enum rol
        text adres
        decimal bakiye
        enum durum
    }

    urunler {
        int id PK
        int kategori_id FK
        varchar album_adi
        varchar sanatci
        decimal fiyat
        int stok
        varchar resim
        enum durum
        tinyint populer
        text aciklama
    }

    sepetler {
        int id PK
        int kullanici_id FK
        datetime guncelleme_tarihi
    }

    sepet_icerik {
        int id PK
        int sepet_id FK
        int urun_id FK
        int adet
    }

    siparisler {
        int id PK
        int kullanici_id FK
        decimal toplam_tutar
        text kargo_adresi
        varchar odeme_yontemi
        varchar durum
        datetime tarih
        decimal bakiye_kullanilan
        decimal karttan_odenen
        varchar siparis_asamasi
    }

    siparis_detaylari {
        int id PK
        int siparis_id FK
        int urun_id FK
        int adet
        decimal birim_fiyat
    }

    mesajlar {
        int id PK
        varchar ad_soyad
        varchar eposta
        varchar konu
        text mesaj
        tinyint okundu
        datetime tarih
    }
````
---

###  UML Sınıf Diyagramı
 
```mermaid
classDiagram
    class Kullanicilar {
        +int id PK
        +varchar ad_soyad
        +varchar eposta
        +varchar telefon
        +varchar sifre
        +enum rol
        +text adres
        +decimal bakiye
        +enum durum
    }
 
    class Kategoriler {
        +int id PK
        +varchar kategori_adi
    }
 
    class Urunler {
        +int id PK
        +int kategori_id FK
        +varchar album_adi
        +varchar sanatci
        +decimal fiyat
        +int stok
        +varchar resim
        +enum durum
        +tinyint populer
        +text aciklama
    }
 
    class Sepetler {
        +int id PK
        +int kullanici_id FK
        +datetime guncelleme_tarihi
    }
 
    class SepetIcerik {
        +int id PK
        +int sepet_id FK
        +int urun_id FK
        +int adet
    }
 
    class Siparisler {
        +int id PK
        +int kullanici_id FK
        +decimal toplam_tutar
        +text kargo_adresi
        +varchar odeme_yontemi
        +varchar durum
        +datetime tarih
        +decimal bakiye_kullanilan
        +decimal karttan_odenen
        +varchar siparis_asamasi
    }
 
    class SiparisDetaylari {
        +int id PK
        +int siparis_id FK
        +int urun_id FK
        +int adet
        +decimal birim_fiyat
    }
 
    class Mesajlar {
        +int id PK
        +varchar ad_soyad
        +varchar eposta
        +varchar konu
        +text mesaj
        +tinyint okundu
        +datetime tarih
    }
 
    Kullanicilar "1" --> "N" Sepetler : sahip olur
    Kullanicilar "1" --> "N" Siparisler : verir
    Kategoriler "1" --> "N" Urunler : içerir
    Sepetler "1" --> "N" SepetIcerik : barındırır
    Urunler "1" --> "N" SepetIcerik : yer alır
    Siparisler "1" --> "N" SiparisDetaylari : içerir
    Urunler "1" --> "N" SiparisDetaylari : yer alır
```
 
#### Controller — Model Eşleşmesi
 
| Controller | Model(ler) | Açıklama |
|---|---|---|
| `Auth` | `KullaniciModel` | Giriş, kayıt, çıkış |
| `Home` | `UrunModel`, `KategoriModel` | Ana sayfa, hakkımızda, iletişim |
| `UrunController` | `UrunModel`, `KategoriModel` | Kategori listesi, ürün detayı |
| `SepetController` | `SepetModel`, `SepetIcerikModel`, `UrunModel` | Sepet işlemleri |
| `SiparisController` | `SiparisModel`, `SiparisDetayModel`, `SepetModel`, `UrunModel` | Ödeme, sipariş, iptal, fatura |
| `ProfilController` | `KullaniciModel` | Profil güncelleme, şifre, hesap dondur |
| `Admin` | Tüm modeller | Yönetim paneli |
 

---
 
##  Veritabanı Tabloları
 
| Tablo | Açıklama |
|-------|----------|
| `kullanicilar` | Kullanıcı hesapları (ad, e-posta, şifre, rol, bakiye, durum) |
| `urunler` | Albüm bilgileri (album_adi, sanatci, fiyat, stok, resim, durum, populer) |
| `kategoriler` | Ürün kategorileri |
| `sepetler` | Kullanıcı sepet başlıkları |
| `sepet_icerik` | Sepetteki ürün kalemleri (adet, urun_id) |
| `siparisler` | Sipariş kayıtları (kullanici_id, toplam tutar, aşama, tarih) |
| `siparis_detay` | Sipariş satır detayları |
| `mesajlar` | İletişim formu mesajları (ad_soyad, eposta, konu, mesaj, okundu, tarih) |
 
---
 
##  Özellikler
 
### Kullanıcı Tarafı
-  Anasayfada popüler albümleri listeleme
-  Kategoriye göre ürün filtreleme
-  Sepete ürün ekleme, güncelleme ve silme
-  Bakiye ile ödeme & sipariş tamamlama
-  Sipariş geçmişi görüntüleme, iptal ve teslim alma
-  Sipariş faturası görüntüleme
-  Profil bilgisi ve şifre güncelleme, hesap dondurma
-  Kargo takip sayfası
### Yönetici Paneli (`/admin`)
-  Genel istatistik paneli
-  Ürün ekleme, düzenleme, silme; durum ve popülerlik değiştirme
-  Kullanıcı ekleme, düzenleme, silme; durum değiştirme
-  Sipariş listeleme, onaylama ve aşama ilerleme
-  İletişim formundan gelen mesajları görüntüleme, okundu işaretleme ve silme 
---
 
##  Yetkilendirme
 
Uygulama oturum tabanlı yetkilendirme kullanmaktadır:
 
- **Giriş yapılmamış kullanıcılar** sepet, ödeme, profil ve kargo takip sayfalarına yönlendirilir.
- **`rol` alanı** `admin` olan kullanıcılar yönetici paneline erişebilir.
- Şifreler veritabanına hash'lenerek kaydedilmektedir.
---
 
##  Notlar
 
- `writable/` klasörüne (cache, log, session) web sunucusunun yazma yetkisi olmalıdır.
- Ürün görselleri `public/uploads/` klasörüne yüklenmektedir; bu klasörün de yazılabilir olması gerekir.
- Proje geliştirme ortamı için yapılandırılmıştır; canlıya almadan önce `.env` dosyasında `CI_ENVIRONMENT = production` yapın ve `app.baseURL` adresini güncelleyin.
---
