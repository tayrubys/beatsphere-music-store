<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Profili</h2>
            <p class="text-muted mb-0">Hesap bilgilerinizi görüntüleyin ve şifrenizi güncelleyin.</p>
        </div>
        <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">Admin Paneline Dön</a>
    </div>

    <?php if (session()->getFlashdata('basari')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('basari') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('hata') ?></div>
    <?php endif; ?>

    <!-- Bilgiler -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Hesap Bilgileri</h5>
            <p class="mb-1"><strong>Ad Soyad:</strong> <?= esc($kullanici['ad_soyad']) ?></p>
            <p class="mb-1"><strong>E-posta:</strong> <?= esc($kullanici['eposta']) ?></p>
            <p class="mb-0"><strong>Rol:</strong> <?= esc($kullanici['rol']) ?></p>
        </div>
    </div>
<!-- Bilgi güncelleme -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">Bilgileri Güncelle</h5>
        <form action="<?= base_url('admin/profil-guncelle') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Ad Soyad</label>
                <input type="text" name="ad_soyad" class="form-control"
                       value="<?= esc($kullanici['ad_soyad']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-posta</label>
                <input type="email" name="eposta" class="form-control"
                       value="<?= esc($kullanici['eposta']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="text" name="telefon" class="form-control"
                       value="<?= esc($kullanici['telefon']) ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Bilgileri Güncelle</button>
        </form>
    </div>
</div>
    <!-- Şifre değiştir -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Şifre Değiştir</h5>
            <form action="<?= base_url('admin/sifre-guncelle') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Mevcut Şifre</label>
                    <input type="password" name="mevcut_sifre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Yeni Şifre</label>
                    <input type="password" name="yeni_sifre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Yeni Şifre Tekrar</label>
                    <input type="password" name="yeni_sifre_tekrar" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Şifreyi Güncelle</button>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>