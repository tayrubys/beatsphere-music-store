<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<style>
    .fatura-wrapper {
        max-width: 1000px;
        margin: 50px auto;
        background: #fff;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .fatura-baslik {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .fatura-logo {
        font-size: 28px;
        font-weight: 800;
        color: #0d6efd;
    }

    .fatura-bilgi-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 18px;
        height: 100%;
    }

    .fatura-table th {
        background: #f8f9fa;
    }

    .fatura-toplam-box {
        max-width: 420px;
        margin-left: auto;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 18px;
    }

    @media print {
        header,
        footer,
        .yazdir-alani,
        .btn {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .fatura-wrapper {
            box-shadow: none;
            margin: 0;
            max-width: 100%;
            border-radius: 0;
        }
    }
</style>

<div class="container">

    <div class="fatura-wrapper">

        <div class="d-flex justify-content-between align-items-start fatura-baslik">

            <div>
                <div class="fatura-logo">
                    <i class="fa-solid fa-compact-disc"></i>
                    BeatSphere
                </div>

                <p class="text-muted mb-0">
                    Albüm Satış Platformu
                </p>
            </div>

            <div class="text-end">
                <h3 class="fw-bold mb-1">Fatura</h3>

                <p class="mb-1">
                    <strong>Fatura No:</strong>
                    BS-<?= str_pad($siparis['id'], 5, '0', STR_PAD_LEFT) ?>
                </p>

                <p class="mb-0">
                    <strong>Tarih:</strong>
                    <?= esc($siparis['tarih']) ?>
                </p>
            </div>

        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-6">
                <div class="fatura-bilgi-box">
                    <h5 class="fw-bold mb-3">Müşteri Bilgileri</h5>

                    <p class="mb-2">
                        <strong>Ad Soyad:</strong>
                        <?= esc($siparis['ad_soyad']) ?>
                    </p>

                    <p class="mb-2">
                        <strong>E-Posta:</strong>
                        <?= esc($siparis['eposta']) ?>
                    </p>

                    <p class="mb-0">
                        <strong>Telefon:</strong>
                        <?= esc($siparis['telefon']) ?>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="fatura-bilgi-box">
                    <h5 class="fw-bold mb-3">Sipariş Bilgileri</h5>

                    <p class="mb-2">
                        <strong>Sipariş No:</strong>
                        #<?= esc($siparis['id']) ?>
                    </p>

                    <p class="mb-2">
                        <strong>Ödeme Yöntemi:</strong>
                        <?= esc($siparis['odeme_yontemi']) ?>
                    </p>

                    <p class="mb-0">
                        <strong>Durum:</strong>
                        <?= esc($siparis['durum']) ?>
                    </p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="fatura-bilgi-box">
                    <h5 class="fw-bold mb-3">Teslimat / Kargo Adresi</h5>

                    <div style="white-space: pre-line;">
                        <?= esc($siparis['kargo_adresi']) ?>
                    </div>
                </div>
            </div>

        </div>

        <h5 class="fw-bold mb-3">Ürünler</h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle fatura-table">
                <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Sanatçı</th>
                        <th class="text-center">Adet</th>
                        <th class="text-end">Birim Fiyat</th>
                        <th class="text-end">Ara Toplam</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($siparis_urunleri as $urun): ?>
                        <tr>
                            <td>
                                <?= esc($urun['album_adi']) ?>
                            </td>

                            <td>
                                <?= esc($urun['sanatci']) ?>
                            </td>

                            <td class="text-center">
                                <?= esc($urun['adet']) ?>
                            </td>

                            <td class="text-end">
                                <?= number_format($urun['birim_fiyat'], 2) ?> ₺
                            </td>

                            <td class="text-end fw-bold">
                                <?= number_format($urun['adet'] * $urun['birim_fiyat'], 2) ?> ₺
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="fatura-toplam-box mt-4">

            <div class="d-flex justify-content-between mb-2">
                <span>Sipariş Toplamı:</span>
                <strong><?= number_format($siparis['toplam_tutar'], 2) ?> ₺</strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span>Cüzdandan Kullanılan:</span>
                <strong><?= number_format($siparis['bakiye_kullanilan'], 2) ?> ₺</strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span>Karttan / Diğer Ödeme:</span>
                <strong><?= number_format($siparis['karttan_odenen'], 2) ?> ₺</strong>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <span class="fw-bold">Genel Toplam:</span>
                <strong class="text-primary fs-5">
                    <?= number_format($siparis['toplam_tutar'], 2) ?> ₺
                </strong>
            </div>

        </div>

        <div class="d-flex justify-content-between mt-4 yazdir-alani">

            <?php if (session()->get('rol') == 'admin'): ?>
                <a href="<?= base_url('admin/siparisler') ?>" class="btn btn-outline-secondary">
                    Siparişlere Dön
                </a>
            <?php else: ?>
                <a href="<?= base_url('siparis-detay/' . $siparis['id']) ?>" class="btn btn-outline-secondary">
                    Sipariş Detayına Dön
                </a>
            <?php endif; ?>

            <button type="button" onclick="window.print()" class="btn btn-primary">
                <i class="fa-solid fa-print me-1"></i>
                Yazdır
            </button>

        </div>

    </div>

</div>

<?= $this->endSection() ?>