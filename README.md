<div align="center">
#  BeatSphere
 
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
    AP3 --> SO[Sipariş Onayla]
    SO --> SA[Aşama İlerlet\ntedarik → kargoda → teslim edildi]
 
    B -- Kullanıcı --> F[Anasayfa\nPopüler albümler]
    F --> G[Kategori\nÜrünler filtrelenir]
    F --> H[Ürün Detay\nAlbüm bilgisi + adet]
    F --> PR[Profil\nBilgi + siparişler]
    PR --> PR1[Bilgi / Şifre Güncelle\nHesap Dondur]
 
    H --> I[Sepet\nekle / güncelle / sil]
    I -- Sepet boş --> ERR1[Hata Yönlendirme]
    I --> J[Ödeme Sayfası\nKargo adresi + yöntem]
    J --> K[Sipariş Tamamla\nStok düş · Bakiye güncelle · Sepeti temizle]
    K -- Transaction hatası --> ERR2[Rollback]
    K --> L[Sipariş Beklemede]
 
    L -- Kullanıcı --> IPS[İptal Et\nStok + bakiye iade]
    SA --> TES[Teslim Alındı\nKullanıcı teyit eder]
    TES --> FAT[Fatura Görüntüle]
 
    style A fill:#1c3557,color:#b5d4f4
    style B fill:#243B55,color:#b5d4f4
    style C fill:#243B55,color:#b5d4f4
    style D fill:#243B55,color:#b5d4f4
    style E fill:#5a1a1a,color:#f09595
    style ERR1 fill:#5a1a1a,color:#f09595
    style ERR2 fill:#5a1a1a,color:#f09595
    style AP fill:#3a2a00,color:#FAC775
    style AP1 fill:#3a2a00,color:#FAC775
    style AP2 fill:#3a2a00,color:#FAC775
    style AP3 fill:#3a2a00,color:#FAC775
    style SO fill:#3a2a00,color:#FAC775
    style SA fill:#3a2a00,color:#FAC775
    style F fill:#0a2a22,color:#9FE1CB
    style G fill:#0a2a22,color:#9FE1CB
    style H fill:#0a2a22,color:#9FE1CB
    style I fill:#0a2a22,color:#9FE1CB
    style J fill:#1a1040,color:#AFA9EC
    style K fill:#1a1040,color:#AFA9EC
    style L fill:#0a2010,color:#C0DD97
    style PR fill:#0a1a30,color:#B5D4F4
    style PR1 fill:#0a1a30,color:#B5D4F4
    style IPS fill:#2a1010,color:#F5C4B3
    style TES fill:#0a2010,color:#C0DD97
    style FAT fill:#1c3557,color:#b5d4f4
```
 
---
 
### Varlık-İlişki (ER) Diyagramı
 
```mermaid
erDiagram
    kullanicilar {
        int id PK
        string ad_soyad
        string eposta
        string telefon
        string sifre
        string rol
        string adres
        decimal bakiye
        string durum
    }
    kategoriler {
        int id PK
        string kategori_adi
    }
    urunler {
        int id PK
        int kategori_id FK
        string album_adi
        string sanatci
        decimal fiyat
        int stok
        string resim
        string durum
        tinyint populer
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
        string kargo_adresi
        string odeme_yontemi
        string durum
        string siparis_asamasi
        datetime tarih
        decimal bakiye_kullanilan
        decimal karttan_odenen
    }
    siparis_detaylari {
        int id PK
        int siparis_id FK
        int urun_id FK
        int adet
        decimal birim_fiyat
    }
 
    kullanicilar ||--o{ sepetler : "sahip olur"
    kullanicilar ||--o{ siparisler : "verir"
    kategoriler ||--o{ urunler : "içerir"
    sepetler ||--o{ sepet_icerik : "barındırır"
    urunler ||--o{ sepet_icerik : "eklenir"
    siparisler ||--o{ siparis_detaylari : "içerir"
    urunler ||--o{ siparis_detaylari : "satılır"
```
 
---
 
---
##  Kurulum
 
### Gereksinimler
 
- PHP 8.1+
- MySQL 5.7+ veya MariaDB 10.4+
- Apache (mod_rewrite aktif)
- XAMPP / WAMP / Laragon önerilir
### Adımlar
 
**1. Projeyi klonlayın**
 
```bash
git clone https://github.com/kullanici-adi/BeatSphere.git
```
 
> Ya da ZIP olarak indirip `htdocs/` (XAMPP) veya `www/` (WAMP) klasörüne çıkartın.
 
**2. Veritabanını oluşturun**
 
phpMyAdmin veya MySQL komut satırında `beatsphere_db` adlı bir veritabanı oluşturun ve gerekli tabloları import edin:
 
```sql
CREATE DATABASE beatsphere_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```
 
**3. `.env` dosyasını düzenleyin**
 
Proje kök dizinindeki `.env` dosyasını açıp aşağıdaki alanları kendi ortamınıza göre güncelleyin:
 
```env
CI_ENVIRONMENT = development
 
app.baseURL = 'http://localhost/BeatSphere/public/'
 
database.default.hostname = localhost
database.default.database = beatsphere_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```
 
**4. Apache mod_rewrite aktif olduğundan emin olun**
 
`httpd.conf` dosyasında `mod_rewrite` modülünün yorum satırından çıkarılmış olduğunu kontrol edin.
 
**5. Uygulamayı açın**
 
```
http://localhost/BeatSphere/public/
```
 
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
