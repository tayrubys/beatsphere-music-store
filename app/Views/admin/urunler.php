<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Ürün Yönetimi</h2>
            <p class="text-muted mb-0">
                Ürünleri görüntüleyebilir, satış durumunu değiştirebilir ve silebilirsiniz.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/urun-ekle') ?>" class="btn btn-success">
                Yeni Ürün Ekle
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('hata') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('basari')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('basari') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php if (!empty($urunler)): ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Resim</th>
                                <th>Albüm</th>
                                <th>Sanatçı</th>
                                <th>Kategori</th>
                                <th>Fiyat</th>
                                <th>Stok</th>
                                <th>Durum</th>
                                <th>Popüler</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($urunler as $urun): ?>
                                <tr>
                                    <td>
                                        #<?= esc($urun['id']) ?>
                                    </td>

                                    <td>
                                        <img src="<?= esc($urun['resim']) ?>"
                                             alt="<?= esc($urun['album_adi']) ?>"
                                             style="width:60px; height:60px; object-fit:cover; border-radius:10px;">
                                    </td>

                                    <td>
                                        <strong><?= esc($urun['album_adi']) ?></strong>
                                    </td>

                                    <td>
                                        <?= esc($urun['sanatci']) ?>
                                    </td>

                                    <td>
                                        <?= esc($urun['kategori_adi'] ?? 'Kategori Yok') ?>
                                    </td>

                                    <td>
                                        <strong><?= number_format($urun['fiyat'], 2) ?> ₺</strong>
                                    </td>

                                    <td>
                                        <?php if ($urun['stok'] > 0): ?>
                                            <span class="badge bg-success">
                                                <?= esc($urun['stok']) ?> adet
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                Stok yok
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if ($urun['durum'] == 'satista'): ?>
                                            <span class="badge bg-success">Satışta</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Satışta Değil</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if ($urun['populer'] == 1): ?>
                                            <span class="badge bg-primary">Evet</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-dark border">Hayır</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <a href="<?= base_url('admin/urun-duzenle/' . $urun['id']) ?>"
                                               class="btn btn-sm btn-primary">
                                                Düzenle
                                            </a>

                                            <?php if ($urun['durum'] == 'satista'): ?>
                                                <a href="<?= base_url('admin/urun-durum-degistir/' . $urun['id']) ?>"
                                                   class="btn btn-sm btn-warning"
                                                   onclick="return confirm('Bu ürünü satıştan kaldırmak istiyor musunuz?');">
                                                    Satıştan Kaldır
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('admin/urun-durum-degistir/' . $urun['id']) ?>"
                                                   class="btn btn-sm btn-success"
                                                   onclick="return confirm('Bu ürünü tekrar satışa sunmak istiyor musunuz?');">
                                                    Satışa Sun
                                                </a>
                                            <?php endif; ?>

                                            <a href="<?= base_url('admin/urun-populer-degistir/' . $urun['id']) ?>"
                                               class="btn btn-sm btn-info text-white"
                                               onclick="return confirm('Ürünün popüler durumunu değiştirmek istiyor musunuz?');">
                                                Popüler
                                            </a>

                                            <a href="<?= base_url('admin/urun-sil/' . $urun['id']) ?>"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Bu ürünü silmek istiyor musunuz? Siparişte kullanılan ürünleri silmemeye dikkat edin.');">
                                                Sil
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>

                <div class="alert alert-light border mb-0">
                    Henüz ürün bulunmuyor.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>