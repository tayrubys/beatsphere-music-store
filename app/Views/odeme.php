<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('icerik') ?>

<div class="container my-5">

    <h2 class="mb-4 fw-bold">Ödeme ve Sipariş Bilgileri</h2>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('hata') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('siparis-tamamla') ?>" method="post">
        <?= csrf_field() ?>

        <div class="row g-4">

            <!-- SOL TARAF: TESLİMAT VE ÖDEME -->
            <div class="col-lg-7">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">Teslimat Bilgileri</h5>

                        <div class="mb-3">
                            <label class="form-label">Kargo Adresi</label>
                            <textarea name="kargo_adresi"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Kargo adresinizi giriniz"
                                      required></textarea>
                        </div>

                        <h5 class="fw-bold mt-4 mb-3">Ödeme Yöntemi</h5>

                        <select name="odeme_yontemi" id="odeme_yontemi" class="form-select" required>
                            <option value="">Ödeme yöntemi seçiniz</option>
                            <option value="Kredi Kartı">Kredi Kartı</option>
                            <option value="Banka Kartı">Banka Kartı</option>
                            <option value="Kapıda Ödeme">Kapıda Ödeme</option>
                        </select>

                        <!-- KART BİLGİLERİ -->
                        <div id="kart_bilgileri" class="mt-4">

                            <div class="p-3 rounded-4 border bg-light mb-3">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="fa-solid fa-credit-card text-primary"></i>
                                    <strong>Kart Bilgileri</strong>
                                </div>

                                <small class="text-muted">
                                    Bu alan demo amaçlıdır. Gerçek ödeme altyapısı kullanılmamaktadır.
                                </small>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kart Üzerindeki İsim</label>
                                    <input type="text"
                                           name="kart_isim"
                                           class="form-control kart-input"
                                           placeholder="Ad Soyad">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kart Numarası</label>
                                    <input type="text"
                                           name="kart_numarasi"
                                           class="form-control kart-input"
                                           maxlength="19"
                                           placeholder="0000 0000 0000 0000">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Son Kullanma Ayı</label>
                                    <select name="son_kullanma_ay" class="form-select kart-input">
                                        <option value="">Ay</option>

                                        <?php for ($ay = 1; $ay <= 12; $ay++): ?>
                                            <option value="<?= str_pad($ay, 2, '0', STR_PAD_LEFT) ?>">
                                                <?= str_pad($ay, 2, '0', STR_PAD_LEFT) ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Son Kullanma Yılı</label>
                                    <select name="son_kullanma_yil" class="form-select kart-input">
                                        <option value="">Yıl</option>

                                        <?php for ($yil = date('Y'); $yil <= date('Y') + 10; $yil++): ?>
                                            <option value="<?= $yil ?>">
                                                <?= $yil ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CVV</label>
                                    <input type="text"
                                           name="cvv"
                                           class="form-control kart-input"
                                           maxlength="3"
                                           placeholder="123">
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- SAĞ TARAF: SİPARİŞ ÖZETİ -->
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">Sipariş Özeti</h5>

                        <?php foreach ($sepet_urunleri as $urun): ?>
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <strong><?= esc($urun['album_adi']) ?></strong><br>

                                    <small class="text-muted">
                                        <?= esc($urun['adet']) ?> adet x <?= number_format($urun['fiyat'], 2) ?> ₺
                                    </small>
                                </div>

                                <span class="fw-bold">
                                    <?= number_format($urun['adet'] * $urun['fiyat'], 2) ?> ₺
                                </span>
                            </div>
                        <?php endforeach; ?>

                        <div class="d-flex justify-content-between mt-4">
                            <span>Ara Toplam</span>
                            <strong><?= number_format($toplam, 2) ?> ₺</strong>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                            <span>Kargo</span>
                            <strong>0.00 ₺</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Genel Toplam</h5>

                            <h4 class="fw-bold text-primary mb-0">
                                <?= number_format($toplam, 2) ?> ₺
                            </h4>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3 fw-bold">
                            Siparişi Tamamla
                        </button>

                        <a href="<?= base_url('sepet') ?>" class="btn btn-outline-secondary w-100 mt-2">
                            Sepete Geri Dön
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const odemeSelect = document.getElementById('odeme_yontemi');
    const kartBilgileri = document.getElementById('kart_bilgileri');
    const kartInputlari = document.querySelectorAll('.kart-input');

    function kartAlanlariniKontrolEt() {
        const secilenOdeme = odemeSelect.value;

        if (secilenOdeme === 'Kapıda Ödeme' || secilenOdeme === '') {
            kartBilgileri.style.display = 'none';

            kartInputlari.forEach(function (input) {
                input.removeAttribute('required');
                input.value = '';
            });
        } else {
            kartBilgileri.style.display = 'block';

            kartInputlari.forEach(function (input) {
                input.setAttribute('required', 'required');
            });
        }
    }

    odemeSelect.addEventListener('change', kartAlanlariniKontrolEt);

    kartAlanlariniKontrolEt();
});
</script>

<?= $this->endSection() ?>