<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/urun_detay.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('icerik') ?>



<div class="container my-5 detay-wrapper">

    <!-- ÜST ÜRÜN DETAY ALANI -->
    <div class="urun-detay-card">

        <div class="row align-items-center g-4">

            <!-- SOL: ALBÜM RESMİ -->
            <div class="col-md-5">

                <div class="urun-img-box">
                    <img src="<?= esc($urun['resim']) ?>"
                         class="urun-img"
                         alt="<?= esc($urun['album_adi']) ?>">
                </div>

            </div>

            <!-- SAĞ: ÜRÜN BİLGİLERİ -->
            <div class="col-md-7">

                <h1 class="urun-title">
                    <?= esc($urun['album_adi']) ?>
                </h1>

                <div class="urun-artist">
                    <?= esc($urun['sanatci']) ?>
                </div>

                <div class="urun-price">
                    <?= number_format($urun['fiyat'], 2) ?> ₺
                </div>

                <div class="urun-meta">
                    <strong>Kategori</strong>
                    : Albüm
                </div>

                <div class="urun-meta">
                    <strong>Durum</strong>
                    :
                    <?php if ($urun['stok'] > 0): ?>
                        <span class="stok-badge stok-var">Stokta Var</span>
                    <?php else: ?>
                        <span class="stok-badge stok-yok">Stokta Yok</span>
                    <?php endif; ?>
                </div>

                <div class="urun-meta">
                    <strong>Stok</strong>
                    : <?= esc($urun['stok']) ?> adet
                </div>

                <div class="urun-aciklama">
                    <?= !empty($urun['aciklama']) 
                        ? esc($urun['aciklama']) 
                        : 'Bu ürün için açıklama bulunamadı.' ?>
                </div>

                <!-- SEPET FORMU -->
                <form action="<?= base_url('/sepete-ekle') ?>" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="urun_id" value="<?= esc($urun['id']) ?>">

                    <div class="d-flex flex-wrap align-items-end gap-3">

                        <div>
                            <label class="fw-bold mb-2">Adet</label>

                            <input type="number"
                                   name="adet"
                                   value="1"
                                   min="1"
                                   max="<?= esc($urun['stok']) ?>"
                                   class="form-control adet-input"
                                   <?= $urun['stok'] <= 0 ? 'disabled' : '' ?>>
                        </div>

                        <button type="submit"
                                class="btn btn-primary detay-btn"
                                <?= $urun['stok'] <= 0 ? 'disabled' : '' ?>>
                            Sepete Ekle
                        </button>

                        <a href="javascript:history.back()"
                           class="btn btn-outline-secondary detay-btn d-flex align-items-center justify-content-center">
                            Geri Dön
                        </a>

                    </div>
                </form>

            </div>

        </div>

    </div>

    <!-- ALT: ÜRÜN ÖZELLİKLERİ -->
    <div class="ozellik-card">

        <h4 class="ozellik-title">Ürün Özellikleri</h4>

        <table class="ozellik-table">
            <tr>
                <td>Sanatçı</td>
                <td><?= esc($urun['sanatci']) ?></td>
            </tr>

            <tr>
                <td>Albüm Adı</td>
                <td><?= esc($urun['album_adi']) ?></td>
            </tr>

            <tr>
                <td>Ürün Tipi</td>
                <td>Fiziksel Albüm</td>
            </tr>

            <tr>
                <td>Kategori</td>
                <td>Albüm</td>
            </tr>

            <tr>
                <td>Stok Durumu</td>
                <td>
                    <?php if ($urun['stok'] > 0): ?>
                        Stokta Var
                    <?php else: ?>
                        Stokta Yok
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <td>Stok Adedi</td>
                <td><?= esc($urun['stok']) ?></td>
            </tr>

            <tr>
                <td>Ödeme</td>
                <td>Kredi kartı / Online ödeme</td>
            </tr>

            <tr>
                <td>Kargo</td>
                <td>Sipariş sonrası hazırlanır</td>
            </tr>
        </table>

    </div>

    <!-- BENZER ÜRÜNLER -->
    <div class="benzer-section">

        <h4 class="benzer-title">Benzer Ürünler</h4>

        <div class="row g-4">

            <?php if (!empty($benzerUrunler)): ?>

                <?php foreach ($benzerUrunler as $benzer): ?>

                    <div class="col-6 col-md-3">

                        <div class="benzer-card">

                            <a href="<?= base_url('urun/' . $benzer['id']) ?>">
                                <img src="<?= esc($benzer['resim']) ?>"
                                     class="benzer-img"
                                     alt="<?= esc($benzer['album_adi']) ?>">
                            </a>

                            <div class="benzer-artist">
                                <?= esc($benzer['sanatci']) ?>
                            </div>

                            <div class="benzer-name">
                                <?= esc($benzer['album_adi']) ?>
                            </div>

                            <div class="benzer-price">
                                <?= number_format($benzer['fiyat'], 2) ?> ₺
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="alert alert-light border">
                        Benzer ürün bulunamadı.
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>