<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        .checkout-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }
        
        /* Form Kartları */
        .checkout-card { background-color: #fff; border: 1px solid #eee; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 25px; padding: 25px; }
        .checkout-card h4 { color: #141E30; font-weight: bold; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        
        /* Form Elemanları */
        .form-control, .form-select { border-radius: 8px; padding: 12px 15px; border: 1px solid #ddd; }
        .form-control:focus, .form-select:focus { border-color: #243B55; box-shadow: 0 0 0 0.2rem rgba(36, 59, 85, 0.25); }
        .form-label { font-weight: 500; color: #555; }
        
        /* Sipariş Özeti Kartı */
        .summary-card { background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 10px; padding: 25px; position: sticky; top: 100px; }
        .btn-pay { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 1.2rem; transition: 0.3s; width: 100%; margin-top: 20px;}
        .btn-pay:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4); color: white; }
    </style>

    <section class="checkout-header text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold"><i class="fa-solid fa-credit-card me-3"></i>Güvenli Ödeme</h1>
            <p class="lead mb-0" style="opacity: 0.8;">Siparişinizi tamamlamak için son bir adım kaldı.</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row">
            
            <div class="col-lg-8">
                
                <div class="checkout-card">
                    <h4><i class="fa-solid fa-map-location-dot me-2 text-primary"></i> Teslimat Bilgileri</h4>
                    <form action="#" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Adınız</label>
                                <input type="text" class="form-control" placeholder="Örn: Şevval Ceren" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Soyadınız</label>
                                <input type="text" class="form-control" placeholder="Örn: Yıldız" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-Posta Adresi</label>
                                <input type="email" class="form-control" placeholder="iletisim@ornek.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefon Numarası</label>
                                <input type="text" class="form-control" placeholder="05XX XXX XX XX" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Adres</label>
                                <input type="text" class="form-control" placeholder="Albümlerin teslim edileceği açık adres..." required>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="checkout-card">
                    <h4><i class="fa-solid fa-lock me-2 text-success"></i>Bilgileri</h4>
                    <div class="alert alert-info mb-4" style="background-color: #e8f4fd; border-color: #b8daff; color: #004085;">
                        <i class="fa-solid fa-shield-halved me-2"></i> Kart bilgileriniz 256-bit SSL sertifikası ile şifrelenerek korunmaktadır.
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Kart Üzerindeki İsim</label>
                            <input type="text" class="form-control" placeholder="AD SOYAD" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Kart Numarası</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" required>
                                <span class="input-group-text bg-light"><i class="fa-brands fa-cc-visa fa-lg me-1"></i> <i class="fa-brands fa-cc-mastercard fa-lg"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Son Kullanma Tarihi</label>
                            <input type="text" class="form-control" placeholder="AA / YY" maxlength="5" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CVV / CVC <i class="fa-solid fa-circle-question ms-1 text-muted" title="Kartın arkasındaki 3 haneli güvenlik kodu"></i></label>
                            <input type="text" class="form-control" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h4 class="fw-bold border-bottom pb-3 mb-4" style="color: #141E30;">Sepet Özeti</h4>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">1989 (Taylor's Version)</span>
                        <span class="fw-bold">450.00 ₺</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                        <span class="text-muted">AM (Arctic Monkeys)</span>
                        <span class="fw-bold">760.00 ₺</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Ara Toplam</span>
                        <span class="fw-bold">1,210.00 ₺</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                        <span class="text-muted">Kargo Ücreti</span>
                        <span class="text-success fw-bold">Ücretsiz</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <h5 class="fw-bold mb-0">Ödenecek Tutar</h5>
                        <h4 class="fw-bold mb-0" style="color: #11998e;">1,210.00 ₺</h4>
                    </div>

                    <button class="btn btn-pay">
                        <i class="fa-solid fa-check me-2"></i> Siparişi Tamamla
                    </button>
                    
                    <p class="text-center text-muted small mt-3 mb-0">
                        Siparişi tamamlayarak <a href="#" class="text-decoration-none">Mesafeli Satış Sözleşmesi</a>'ni onaylamış olursunuz.
                    </p>
                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>