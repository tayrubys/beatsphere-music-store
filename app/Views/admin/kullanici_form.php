<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<?php
$formAction = ($islem == 'ekle')
    ? base_url('admin/kullanici-kaydet')
    : base_url('admin/kullanici-guncelle/' . $kullanici['id']);
?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <?= esc($baslik) ?>
            </h2>

            <?php if ($islem == 'ekle'): ?>
                <p class="text-muted mb-0">
                    Bu ekrandan yalnızca admin yetkisine sahip kullanıcı hesabı oluşturulur.
                </p>
            <?php else: ?>
                <p class="text-muted mb-0">
                    Kullanıcı bilgilerini, rolünü, durumunu ve bakiyesini düzenleyebilirsiniz.
                </p>
            <?php endif; ?>
        </div>

        <a href="<?= base_url('admin/kullanicilar') ?>" class="btn btn-outline-secondary">
            Kullanıcılara Dön
        </a>
    </div>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('hata') ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="<?= $formAction ?>" method="post">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ad Soyad</label>
                        <input type="text"
                               name="ad_soyad"
                               class="form-control"
                               value="<?= esc($kullanici['ad_soyad'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">E-Posta</label>
                        <input type="email"
                               name="eposta"
                               class="form-control"
                               value="<?= esc($kullanici['eposta'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text"
                               name="telefon"
                               class="form-control"
                               value="<?= esc($kullanici['telefon'] ?? '') ?>"
                               required>
                    </div>

                    <?php if ($islem == 'ekle'): ?>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password"
                                   name="sifre"
                                   class="form-control"
                                   placeholder="En az 6 karakter"
                                   required>
                        </div>

                    <?php endif; ?>

                    <?php if ($islem == 'duzenle'): ?>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bakiye</label>
                            <input type="number"
                                   step="0.01"
                                   name="bakiye"
                                   class="form-control"
                                   value="<?= esc($kullanici['bakiye']) ?>"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rol</label>
                            <select name="rol" class="form-select" required>
                                <option value="user" <?= $kullanici['rol'] == 'user' ? 'selected' : '' ?>>
                                    User
                                </option>

                                <option value="admin" <?= $kullanici['rol'] == 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Durum</label>
                            <select name="durum" class="form-select" required>
                                <option value="aktif" <?= $kullanici['durum'] == 'aktif' ? 'selected' : '' ?>>
                                    Aktif
                                </option>

                                <option value="pasif" <?= $kullanici['durum'] == 'pasif' ? 'selected' : '' ?>>
                                    Pasif
                                </option>
                            </select>
                        </div>

                    <?php endif; ?>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Adres</label>
                        <textarea name="adres"
                                  class="form-control"
                                  rows="4"
                                  required><?= esc($kullanici['adres'] ?? '') ?></textarea>
                    </div>

                </div>

                <?php if ($islem == 'ekle'): ?>
                    <div class="alert alert-warning">
                        Bu ekrandan oluşturulan hesap otomatik olarak
                        <strong>admin</strong> rolünde ve
                        <strong>aktif</strong> durumda kaydedilir.
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-success">
                    <?= $islem == 'ekle' ? 'Admin Kullanıcısı Ekle' : 'Kullanıcıyı Güncelle' ?>
                </button>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>