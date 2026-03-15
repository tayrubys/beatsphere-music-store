<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        .cart-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }
        .cart-table th { background-color: #f8f9fa; color: #141E30; font-weight: bold; border-bottom: 2px solid #ddd; }
        .cart-table td { vertical-align: middle; }
        .album-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .qty-btn { background-color: #eee; border: none; padding: 5px 12px; font-weight: bold; border-radius: 5px; color: #333; transition: 0.2s; }
        .qty-btn:hover { background-color: #ddd; }
        .qty-input { width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 5px; margin: 0 5px; font-weight: bold; }
        .summary-card { background-color: #fcfcfc; border: 1px solid #eee; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .btn-checkout { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 1.1rem; transition: 0.3s; width: 100%; }
        .btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4); color: white; }
        .btn-remove { color: #dc3545; background: none; border: none; font-size: 1.2rem; transition: 0.2s; }
        .btn-remove:hover { color: #a71d2a; transform: scale(1.1); }
    </style>

    <section class="cart-header text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold"><i class="fa-solid fa-cart-shopping me-3"></i>Alışveriş Sepetim</h1>
            <p class="lead mb-0" style="opacity: 0.8;">Seçtiğiniz harika albümler burada sizi bekliyor.</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row">
            
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table cart-table mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-start ps-4">Albüm</th>
                                        <th>Fiyat</th>
                                        <th>Adet</th>
                                        <th>Toplam</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($sepet_urunleri) && !empty($sepet_urunleri)): ?>
                                        <?php foreach($sepet_urunleri as $urun): ?>
                                            <tr>
                                                <td class="text-start ps-4 d-flex align-items-center">
                                                    <div class="album-img bg-secondary d-flex align-items-center justify-content-center text-white me-3">
                                                        <i class="fa-solid fa-music fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold"><?= $urun['ad'] ?></h6>
                                                        <small class="text-muted"><?= $urun['sanatci'] ?></small>
                                                    </div>
                                                </td>
                                                <td class="fw-bold"><?= number_format($urun['fiyat'], 2) ?> ₺</td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <button class="qty-btn"><i class="fa-solid fa-minus"></i></button>
                                                        <input type="text" class="qty-input" value="<?= $urun['adet'] ?>" readonly>
                                                        <button class="qty-btn"><i class="fa-solid fa-plus"></i></button>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-primary"><?= number_format($urun['fiyat'] * $urun['adet'], 2) ?> ₺</td>
                                                <td>
                                                    <button class="btn-remove" title="Sepetten Çıkar"><i class="fa-solid fa-trash-can"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="py-5 text-muted text-center">
                                                <i class="fa-solid fa-basket-shopping fa-4x mb-3" style="opacity: 0.2;"></i>
                                                <h5 class="fw-bold">Sepetiniz şu an boş.</h5>
                                                <p class="mb-0">Hemen müzik keşfine çıkıp sepetinizi doldurabilirsiniz!</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="<?= base_url() ?>" class="text-decoration-none fw-bold" style="color: #243B55;">
                        <i class="fa-solid fa-arrow-left me-2"></i> Alışverişe Devam Et
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card p-4">
                    <h4 class="fw-bold border-bottom pb-3 mb-4" style="color: #141E30;">Sipariş Özeti</h4>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Ara Toplam</span>
                        <span class="fw-bold">0.00 ₺</span> 
                    </div>
                    <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                        <span class="text-muted">Kargo Ücreti</span>
                        <span class="fw-bold">0.00 ₺</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="fw-bold mb-0">Genel Toplam</h5>
                        <h4 class="fw-bold mb-0" style="color: #11998e;">0.00 ₺</h4>
                    </div>

                    <button onclick="window.location.href='<?= base_url('odeme') ?>'" class="btn btn-checkout">
                        Ödemeye Geç <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4 text-muted" style="font-size: 0.85rem;">
                        <p class="mb-2"><i class="fa-solid fa-shield-halved me-1"></i> 256-Bit SSL ile Güvenli Alışveriş</p>
                        <i class="fa-brands fa-cc-visa fa-2x mx-1"></i>
                        <i class="fa-brands fa-cc-mastercard fa-2x mx-1"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>