<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('icerik') ?>

<div class="container my-5">

    <h2 class="mb-4">
        <?= esc($kategori['kategori_adi']) ?> Albümleri
    </h2>

    <div class="row">

        <?php if (!empty($urunler)): ?>
            <?php foreach ($urunler as $urun): ?>

                <div class="col-md-6 col-lg-4 col-xl-3 mb-5">
                    <div class="card text-center card-product border-0">

                        <div class="card-product__img text-center">
                            <img src="<?= esc($urun['resim']) ?>"
                                 alt="<?= esc($urun['album_adi']) ?>"
                                 style="width:250px; height:250px; object-fit:cover;">
                        </div>

                        <div class="card-body p-0">
                            <p class="text-muted mb-1">
                                <?= esc($urun['sanatci']) ?>
                            </p>

                            <h5 class="fw-bold text-dark">
                                <?= esc($urun['album_adi']) ?>
                            </h5>

                            <p class="text-primary fw-bold">
                                <?= number_format($urun['fiyat'], 2) ?> ₺
                            </p>

                            <button class="btn btn-sm btn-outline-primary w-100 rounded-pill">
                                Sepete Ekle
                            </button>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>Bu kategoriye ait ürün bulunamadı.</p>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>