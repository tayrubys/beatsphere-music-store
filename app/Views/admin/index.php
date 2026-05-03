<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="mb-4">
        <h2 class="fw-bold">Admin Paneli</h2>
        <p class="text-muted">
            Hoş geldin, <?= esc(session()->get('ad_soyad')) ?>. Bu panelden ürünleri, siparişleri ve kullanıcı işlemlerini yönetebilirsin.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Ürün Yönetimi</h5>

                    <p class="text-muted">
                        Ürünleri listele, satış durumunu değiştir, popüler ürünleri ayarla ve ürün silme işlemlerini yap.
                    </p>

                    <a href="<?= base_url('admin/urunler') ?>" class="btn btn-primary">
                        Ürünleri Yönet
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Kullanıcı Yönetimi</h5>

                    <p class="text-muted">
                        Kullanıcıları listele, yeni kullanıcı ekle, aktif/pasif yap ve bilgilerini düzenle.
                    </p>

                    <a href="<?= base_url('admin/kullanicilar') ?>" class="btn btn-dark">
                        Kullanıcıları Yönet
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Sipariş Yönetimi</h5>

                    <p class="text-muted">
                        Siparişleri görüntüle, onayla ve sipariş hazırlık/kargo aşamalarını ilerlet.
                    </p>

                    <a href="<?= base_url('admin/siparisler') ?>" class="btn btn-success">
                        Siparişleri Yönet
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Çıkış</h5>

                    <p class="text-muted">
                        Admin oturumunu güvenli şekilde kapat.
                    </p>

                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">
                        Çıkış Yap
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>