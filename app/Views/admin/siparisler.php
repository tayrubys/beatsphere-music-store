<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Sipariş Yönetimi</h2>
            <p class="text-muted mb-0">Siparişleri görüntüleyebilir, onaylayabilir ve kargo sürecini ilerletebilirsiniz.</p>
        </div>

        <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
            Siteye Dön
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

            <?php if (!empty($siparisler)): ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Sipariş No</th>
                                <th>Kullanıcı</th>
                                <th>E-Posta</th>
                                <th>Tutar</th>
                                <th>Ödeme</th>
                                <th>Durum</th>
                                <th>Aşama</th>
                                <th>Tarih</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($siparisler as $siparis): ?>
                                <tr>
                                    <td>#<?= esc($siparis['id']) ?></td>

                                    <td><?= esc($siparis['ad_soyad']) ?></td>

                                    <td><?= esc($siparis['eposta']) ?></td>

                                    <td>
                                        <strong><?= number_format($siparis['toplam_tutar'], 2) ?> ₺</strong>
                                    </td>

                                    <td><?= esc($siparis['odeme_yontemi']) ?></td>

                                    <td>
                                        <?php if ($siparis['durum'] == 'beklemede'): ?>
                                            <span class="badge bg-warning text-dark">Beklemede</span>

                                        <?php elseif ($siparis['durum'] == 'onaylandi'): ?>
                                            <span class="badge bg-primary">Onaylandı</span>

                                        <?php elseif ($siparis['durum'] == 'iptal'): ?>
                                            <span class="badge bg-danger">İptal</span>

                                        <?php elseif ($siparis['durum'] == 'teslim_edildi'): ?>
                                            <span class="badge bg-success">Teslim Edildi</span>

                                        <?php else: ?>
                                            <span class="badge bg-secondary">
                                                <?= esc($siparis['durum']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php
                                            $asamaMetni = [
                                                'beklemede' => 'Beklemede',
                                                'tedarik_ediliyor' => 'Ürünler tedarik ediliyor',
                                                'kutulaniyor' => 'Ürünler kutulanıyor',
                                                'kargoya_verildi' => 'Kargoya verildi',
                                                'yolda' => 'Size doğru yola çıktı',
                                                'teslim_edildi' => 'Teslim edildi',
                                                'iptal' => 'İptal edildi'
                                            ];
                                        ?>

                                        <?= esc($asamaMetni[$siparis['siparis_asamasi']] ?? $siparis['siparis_asamasi']) ?>
                                    </td>

                                    <td><?= esc($siparis['tarih']) ?></td>

                                    <td>
                                        <?php if ($siparis['durum'] == 'beklemede'): ?>
                                            <a href="<?= base_url('siparis-fatura/' . $siparis['id']) ?>"
                                                class="btn btn-sm btn-outline-dark">
                                                Fatura
                                            </a>
                                            <a href="<?= base_url('admin/siparis-onayla/' . $siparis['id']) ?>"
                                               class="btn btn-sm btn-success"
                                               onclick="return confirm('Bu siparişi onaylamak istiyor musunuz?');">
                                                Onayla
                                            </a>

                                        <?php elseif ($siparis['durum'] == 'onaylandi'): ?>

    <a href="<?= base_url('siparis-fatura/' . $siparis['id']) ?>"
       class="btn btn-sm btn-outline-dark">
        Fatura
    </a>
    <a href="<?= base_url('admin/siparis-asama-ilerlet/' . $siparis['id']) ?>"
       class="btn btn-sm btn-primary"
       onclick="return confirm('Sipariş aşamasını ilerletmek istiyor musunuz?');">
        Aşamayı İlerle
    </a>

<?php else: ?>

    <a href="<?= base_url('siparis-fatura/' . $siparis['id']) ?>"
       class="btn btn-sm btn-outline-dark">
        Fatura
    </a>

<?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            <?php else: ?>

                <div class="alert alert-light border mb-0">
                    Henüz sipariş bulunmuyor.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>