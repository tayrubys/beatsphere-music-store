<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/odeme.css') ?>">
<?= $this->endSection() ?>

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

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="payment-option">
                                    <input type="radio"
                                           name="odeme_yontemi"
                                           value="Kredi Kartı"
                                           class="odeme-radio"
                                           required>
                                    <div class="payment-box">
                                        <i class="fa-solid fa-credit-card"></i>
                                        <span>Kredi Kartı</span>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="payment-option">
                                    <input type="radio"
                                           name="odeme_yontemi"
                                           value="Banka Kartı"
                                           class="odeme-radio"
                                           required>
                                    <div class="payment-box">
                                        <i class="fa-solid fa-building-columns"></i>
                                        <span>Banka Kartı</span>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="payment-option">
                                    <input type="radio"
                                           name="odeme_yontemi"
                                           value="Kapıda Ödeme"
                                           class="odeme-radio"
                                           required>
                                    <div class="payment-box">
                                        <i class="fa-solid fa-truck-fast"></i>
                                        <span>Kapıda Ödeme</span>
                                    </div>
                                </label>
                            </div>

                        </div>

                        <!-- KART BİLGİLERİ -->
                        <div id="kart_bilgileri" class="card-info-box mt-4">

                            <div class="card-preview mb-4">
                                <div>
                                    <small>Kart Numarası</small>
                                    <h5 id="preview_kart_no">•••• •••• •••• ••••</h5>
                                </div>

                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <small>Kart Sahibi</small>
                                        <p id="preview_isim">AD SOYAD</p>
                                    </div>

                                    <div>
                                        <small>SKT</small>
                                        <p id="preview_tarih">AA/YY</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 rounded-4 border bg-light mb-3">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="fa-solid fa-lock text-success"></i>
                                    <strong>Güvenli Kart Bilgileri</strong>
                                </div>

                                <small class="text-muted">
                                    Bu ödeme ekranı demo amaçlıdır. Kart bilgileriniz sistemde saklanmaz.
                                </small>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kart Üzerindeki İsim</label>
                                    <input type="text"
                                           id="kart_isim"
                                           name="kart_isim"
                                           class="form-control kart-input"
                                           placeholder="Ad Soyad">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kart Numarası</label>
                                    <input type="text"
                                           id="kart_numarasi"
                                           name="kart_numarasi"
                                           class="form-control kart-input"
                                           maxlength="19"
                                           placeholder="0000 0000 0000 0000">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Son Kullanma Ayı</label>
                                    <select id="son_kullanma_ay"
                                            name="son_kullanma_ay"
                                            class="form-select kart-input">
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
                                    <select id="son_kullanma_yil"
                                            name="son_kullanma_yil"
                                            class="form-select kart-input">
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
                                    <input type="password"
                                           id="cvv"
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
                        <div class="alert alert-info mt-3 mb-2">
                            <strong>Cüzdan Bakiyeniz:</strong>
                            <?= number_format($kullanici['bakiye'], 2) ?> ₺
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
    const odemeRadio = document.querySelectorAll('.odeme-radio');
    const kartBilgileri = document.getElementById('kart_bilgileri');
    const kartInputlari = document.querySelectorAll('.kart-input');

    const kartIsim = document.getElementById('kart_isim');
    const kartNumarasi = document.getElementById('kart_numarasi');
    const sonAy = document.getElementById('son_kullanma_ay');
    const sonYil = document.getElementById('son_kullanma_yil');
    const cvv = document.getElementById('cvv');

    const previewKartNo = document.getElementById('preview_kart_no');
    const previewIsim = document.getElementById('preview_isim');
    const previewTarih = document.getElementById('preview_tarih');

    function secilenOdemeYontemi() {
        const secili = document.querySelector('input[name="odeme_yontemi"]:checked');
        return secili ? secili.value : '';
    }

    function kartAlanlariniKontrolEt() {
        const odemeYontemi = secilenOdemeYontemi();

        if (odemeYontemi === 'Kredi Kartı' || odemeYontemi === 'Banka Kartı') {
            kartBilgileri.style.display = 'block';

            kartInputlari.forEach(function (input) {
                input.setAttribute('required', 'required');
            });
        } else {
            kartBilgileri.style.display = 'none';

            kartInputlari.forEach(function (input) {
                input.removeAttribute('required');
                input.value = '';
            });

            previewKartNo.textContent = '•••• •••• •••• ••••';
            previewIsim.textContent = 'AD SOYAD';
            previewTarih.textContent = 'AA/YY';
        }
    }

    function kartNumarasiFormatla(value) {
        value = value.replace(/\D/g, '');
        value = value.substring(0, 16);
        return value.replace(/(.{4})/g, '$1 ').trim();
    }

    kartNumarasi.addEventListener('input', function () {
        this.value = kartNumarasiFormatla(this.value);
        previewKartNo.textContent = this.value || '•••• •••• •••• ••••';
    });

    kartIsim.addEventListener('input', function () {
        previewIsim.textContent = this.value.toUpperCase() || 'AD SOYAD';
    });

    sonAy.addEventListener('change', tarihGuncelle);
    sonYil.addEventListener('change', tarihGuncelle);

    function tarihGuncelle() {
        const ay = sonAy.value || 'AA';
        const yil = sonYil.value ? sonYil.value.slice(-2) : 'YY';

        previewTarih.textContent = ay + '/' + yil;
    }

    cvv.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').substring(0, 3);
    });

    odemeRadio.forEach(function (radio) {
        radio.addEventListener('change', kartAlanlariniKontrolEt);
    });

    kartAlanlariniKontrolEt();
});
</script>

<?= $this->endSection() ?>