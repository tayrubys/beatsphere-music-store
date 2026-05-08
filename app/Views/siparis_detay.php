<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('icerik') ?>

<?php
$asamaMetni = [
    'beklemede' => 'Siparişiniz beklemede.',
    'tedarik_ediliyor' => 'Ürünleriniz tedarik ediliyor.',
    'kutulaniyor' => 'Ürünleriniz kutulanıyor.',
    'kargoya_verildi' => 'Ürünleriniz kargoya verildi.',
    'yolda' => 'Ürünleriniz size doğru yola çıktı.',
    'teslim_edildi' => 'Ürünleriniz size teslim edilmiştir.',
    'teslim_alindi' => 'Siparişi teslim aldınız.',
    'iptal' => 'Sipariş iptal edildi.'
];

$asamaSirasi = [
    'beklemede' => 0,
    'tedarik_ediliyor' => 1,
    'kutulaniyor' => 2,
    'kargoya_verildi' => 3,
    'yolda' => 4,
    'teslim_edildi' => 5,
    'teslim_alindi' => 6
];

$aktifAsamaIndex = $asamaSirasi[$siparis['siparis_asamasi']] ?? 0;
?>

<style>
    .takip-wrapper {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 25px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }

    .takip-baslik {
        font-weight: 700;
        margin-bottom: 20px;
        color: #1f2937;
    }

    .takip-steps {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        position: relative;
    }

    .takip-step {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .takip-step:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 17px;
        left: 55%;
        width: 90%;
        height: 4px;
        background: #d1d5db;
        z-index: 0;
        border-radius: 10px;
    }

    .takip-step.active:not(:last-child)::after,
    .takip-step.current:not(:last-child)::after {
        background: #198754;
    }

    .takip-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #d1d5db;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        position: relative;
        z-index: 1;
        margin-bottom: 8px;
    }

    .takip-step.active .takip-circle {
        background: #198754;
    }

    .takip-step.current .takip-circle {
        background: #0d6efd;
        transform: scale(1.1);
    }

    .takip-label {
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
        line-height: 1.3;
    }

    .takip-step.active .takip-label,
    .takip-step.current .takip-label {
        color: #212529;
    }

    @media (max-width: 768px) {
        .takip-steps {
            flex-direction: column;
            gap: 18px;
        }

        .takip-step {
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .takip-step:not(:last-child)::after {
            display: none;
        }

        .takip-circle {
            margin-bottom: 0;
        }
    }
</style>

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

    <?php if ($siparis['siparis_asamasi'] != 'iptal'): ?>

        <div class="takip-wrapper">
            <h5 class="takip-baslik">Sipariş Takibi</h5>

            <div class="takip-steps">
                <?php
                $gosterilecekAsamalar = [
                    'beklemede' => 'Onay Bekliyor',
                    'tedarik_ediliyor' => 'Tedarik',
                    'kutulaniyor' => 'Kutulandı',
                    'kargoya_verildi' => 'Kargoya Verildi',
                    'yolda' => 'Yolda',
                    'teslim_edildi' => 'Teslim Edildi'
                ];

                $i = 0;
                foreach ($gosterilecekAsamalar as $anahtar => $etiket):
                    $stepClass = '';

                    if ($aktifAsamaIndex > $i) {
                        $stepClass = 'active';
                    } elseif ($aktifAsamaIndex == $i) {
                        $stepClass = 'current';
                    }

                    if ($siparis['siparis_asamasi'] == 'teslim_alindi') {
                        $stepClass = 'active';
                    }
                ?>
                    <div class="takip-step <?= $stepClass ?>">
                        <div class="takip-circle">
                            <?php if ($stepClass == 'active'): ?>
                                <i class="fa-solid fa-check"></i>
                            <?php else: ?>
                                <?= $i + 1 ?>
                            <?php endif; ?>
                        </div>

                        <div class="takip-label">
                            <?= esc($etiket) ?>
                        </div>
                    </div>
                <?php
                    $i++;
                endforeach;
                ?>
            </div>

            <?php if ($siparis['siparis_asamasi'] == 'teslim_alindi'): ?>
                <div class="alert alert-success mt-3 mb-0">
                    Siparişi teslim aldınız.
                </div>
            <?php endif; ?>
        </div>

    <?php else: ?>

        <div class="alert alert-danger">
            Bu sipariş iptal edilmiştir.
        </div>

    <?php endif; ?>

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

                        <?php elseif ($siparis['durum'] == 'teslim_alindi'): ?>
                            <span class="badge bg-success">Teslim Alındı</span>

                        <?php else: ?>
                            <span class="badge bg-secondary">
                                <?= esc($siparis['durum']) ?>
                            </span>
                        <?php endif; ?>
                    </p>

                    <hr>

                    <h6 class="fw-bold mb-2">Sipariş Aşaması</h6>

                    <div class="alert alert-info mb-3">
                        <?= esc($asamaMetni[$siparis['siparis_asamasi']] ?? $siparis['siparis_asamasi']) ?>
                    </div>

                    <p class="mb-1">
                        <strong>Kargo Adresi:</strong>
                    </p>

                    <p class="text-muted mb-0">
                        <?= esc($siparis['kargo_adresi']) ?>
                    </p>
<hr>

<?php if ($siparis['durum'] != 'beklemede' && $siparis['durum'] != 'iptal'): ?>
    <a href="<?= base_url('siparis-fatura/' . $siparis['id']) ?>"
       class="btn btn-outline-primary w-100">
        Fatura Görüntüle
    </a>
<?php endif; ?>

                    <?php if ($siparis['durum'] == 'beklemede'): ?>
                        <hr>

                        <a href="<?= base_url('siparis-iptal/' . $siparis['id']) ?>"
                           class="btn btn-outline-danger w-100"
                           onclick="return confirm('Bu siparişi iptal etmek istiyor musunuz?')">
                            Siparişi İptal Et
                        </a>
                    <?php endif; ?>

                    <?php if ($siparis['siparis_asamasi'] == 'teslim_edildi'): ?>
                        <hr>

                        <a href="<?= base_url('siparis-teslim-aldim/' . $siparis['id']) ?>"
                           class="btn btn-success w-100"
                           onclick="return confirm('Bu siparişi teslim aldığınızı onaylıyor musunuz?')">
                            Ürünlerimi Teslim Aldım
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

                        <div class="text-end mb-3">
                            <h4 class="fw-bold">
                                Genel Toplam:
                                <span class="text-primary">
                                    <?= number_format($siparis['toplam_tutar'], 2) ?> ₺
                                </span>
                            </h4>
                        </div>

                        <div class="mt-4 p-3 border rounded-4 bg-light">
                            <h5 class="fw-bold mb-3">Ödeme Bilgileri</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Sipariş Toplamı:</span>
                                <strong><?= number_format($siparis['toplam_tutar'], 2) ?> ₺</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Cüzdandan Kullanılan:</span>
                                <strong><?= number_format($siparis['bakiye_kullanilan'], 2) ?> ₺</strong>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span>Karttan / Diğer Ödeme:</span>
                                <strong><?= number_format($siparis['karttan_odenen'], 2) ?> ₺</strong>
                            </div>
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