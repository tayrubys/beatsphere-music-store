
<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('icerik') ?>

<div class="container my-5">

    <?php if (session()->getFlashdata('basari')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('basari') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('hata') ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Sipariş Detayı</h2>

        <a href="<?= base_url('profil') ?>" class="btn btn-outline-secondary">
            Profilime Dön
        </a>
    </div>

    <div class="row g-4">

        <!-- SOL: SİPARİŞ BİLGİLERİ -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Sipariş Bilgileri</h5>

                    <p class="mb-2">
                        <strong>Sipariş No:</strong>
                        #<?= esc($siparis['id']) ?>
                    </p>

                    <p class="mb-2">
                        <strong>Tarih:</strong>
                        <?= esc($siparis['tarih']) ?>
                    </p>

                    <p class="mb-2">
                        <strong>Ödeme:</strong>
                        <?= esc($siparis['odeme_yontemi']) ?>
                    </p>

                    <p class="mb-2">
                        <strong>Durum:</strong>

                        <?php if ($siparis['durum'] == 'beklemede'): ?>
                            <span class="badge bg-warning text-dark">Beklemede</span>
                        <?php elseif ($siparis['durum'] == 'onaylandi'): ?>
                            <span class="badge bg-info">Onaylandı</span>
                        <?php elseif ($siparis['durum'] == 'iptal'): ?>
                            <span class="badge bg-danger">İptal Edildi</span>
                        <?php elseif ($siparis['durum'] == 'teslim_edildi'): ?>
                            <span class="badge bg-success">Teslim Edildi</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">
                                <?= esc($siparis['durum']) ?>
                            </span>
                        <?php endif; ?>
                    </p>

                    <hr>

                    <p class="mb-1">
                        <strong>Kargo Adresi:</strong>
                    </p>

                    <p class="text-muted mb-0">
                        <?= esc($siparis['kargo_adresi']) ?>
                    </p>

                    <?php if ($siparis['durum'] == 'beklemede'): ?>
                        <hr>

                        <a href="<?= base_url('siparis-iptal/' . $siparis['id']) ?>"
                           class="btn btn-outline-danger w-100"
                           onclick="return confirm('Bu siparişi iptal etmek istiyor musunuz?')">
                            Siparişi İptal Et
                        </a>
                    <?php endif; ?>

                </div>
            </div>

        </div>

        <!-- SAĞ: ÜRÜNLER -->
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Sipariş Ürünleri</h5>

                    <?php if (!empty($siparis_urunleri)): ?>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Adet</th>
                                        <th>Birim Fiyat</th>
                                        <th>Ara Toplam</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($siparis_urunleri as $urun): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="<?= esc($urun['resim']) ?>"
                                                         alt="<?= esc($urun['album_adi']) ?>"
                                                         style="width:70px; height:70px; object-fit:cover; border-radius:10px;">

                                                    <div>
                                                        <strong><?= esc($urun['album_adi']) ?></strong><br>

                                                        <small class="text-muted">
                                                            <?= esc($urun['sanatci']) ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <?= esc($urun['adet']) ?>
                                            </td>

                                            <td>
                                                <?= number_format($urun['birim_fiyat'], 2) ?> ₺
                                            </td>

                                            <td class="fw-bold text-primary">
                                                <?= number_format($urun['adet'] * $urun['birim_fiyat'], 2) ?> ₺
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <div class="text-end">
                            <h4 class="fw-bold">
                                Genel Toplam:
                                <span class="text-primary">
                                    <?= number_format($siparis['toplam_tutar'], 2) ?> ₺
                                </span>
                            </h4>
                        </div>

                    <?php else: ?>

                        <div class="alert alert-light border">
                            Bu siparişe ait ürün bulunamadı.
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>