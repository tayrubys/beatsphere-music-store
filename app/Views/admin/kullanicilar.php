<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Kullanıcı Yönetimi</h2>
            <p class="text-muted mb-0">
                Kullanıcıları görüntüleyebilir, düzenleyebilir, aktif/pasif yapabilir veya silebilirsiniz.
            </p>
        </div>

        <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">
            Admin Paneli
        </a>
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

            <?php if (!empty($kullanicilar)): ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad Soyad</th>
                                <th>E-Posta</th>
                                <th>Telefon</th>
                                <th>Rol</th>
                                <th>Bakiye</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($kullanicilar as $kullanici): ?>
                                <tr>
                                    <td>#<?= esc($kullanici['id']) ?></td>

                                    <td>
                                        <strong><?= esc($kullanici['ad_soyad']) ?></strong>
                                    </td>

                                    <td><?= esc($kullanici['eposta']) ?></td>

                                    <td><?= esc($kullanici['telefon']) ?></td>

                                    <td>
                                        <?php if ($kullanici['rol'] == 'admin'): ?>
                                            <span class="badge bg-dark">Admin</span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">User</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?= number_format($kullanici['bakiye'], 2) ?> ₺
                                    </td>

                                    <td>
                                        <?php if ($kullanici['durum'] == 'aktif'): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Pasif</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-1">

                                            <a href="<?= base_url('admin/kullanici-duzenle/' . $kullanici['id']) ?>"
                                               class="btn btn-sm btn-primary">
                                                Düzenle
                                            </a>

                                            <?php if ($kullanici['id'] != session()->get('kullanici_id')): ?>

                                                <a href="<?= base_url('admin/kullanici-durum-degistir/' . $kullanici['id']) ?>"
                                                   class="btn btn-sm btn-warning"
                                                   onclick="return confirm('Kullanıcının durumunu değiştirmek istiyor musunuz?');">
                                                    Aktif/Pasif
                                                </a>

                                                <a href="<?= base_url('admin/kullanici-sil/' . $kullanici['id']) ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Bu kullanıcıyı silmek istiyor musunuz?');">
                                                    Sil
                                                </a>

                                            <?php else: ?>

                                                <span class="text-muted small">Kendi hesabınız</span>

                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            <?php else: ?>

                <div class="alert alert-light border mb-0">
                    Kullanıcı bulunmuyor.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>