<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="row">

        <!-- SOL MENÜ -->
        <div class="col-lg-3 mb-4">

            <div class="card profil-card">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fa-solid fa-circle-user fa-5x profil-avatar"></i>
                        </div>

                        <h5 class="mb-1 profil-isim">
                            <?= esc(session()->get('ad_soyad')) ?>
                        </h5>

                        <p class="mb-0 profil-mail">
                            <?= esc(session()->get('eposta')) ?>
                        </p>
                    </div>

                    <div class="nav flex-column nav-pills gap-2 profil-menu"
                         id="v-pills-tab"
                         role="tablist"
                         aria-orientation="vertical">

                        <button class="nav-link active text-start"
                                id="v-pills-profil-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#v-pills-profil"
                                type="button"
                                role="tab">
                            <i class="fa-solid fa-id-card"></i>
                            Profil Bilgileri
                        </button>

                        <button class="nav-link text-start"
                                id="v-pills-cuzdan-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#v-pills-cuzdan"
                                type="button"
                                role="tab">
                            <i class="fa-solid fa-wallet"></i>
                            BeatSphere Cüzdanım
                        </button>

                        <button class="nav-link text-start"
                                id="v-pills-siparis-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#v-pills-siparis"
                                type="button"
                                role="tab">
                            <i class="fa-solid fa-box"></i>
                            Siparişlerim
                        </button>

                        <button class="nav-link text-start"
                                id="v-pills-sifre-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#v-pills-sifre"
                                type="button"
                                role="tab">
                            <i class="fa-solid fa-lock"></i>
                            Şifre Değiştir
                        </button>

                        <button class="nav-link text-start text-danger"
                                id="v-pills-hesap-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#v-pills-hesap"
                                type="button"
                                role="tab">
                            <i class="fa-solid fa-user-slash"></i>
                            Hesabı Dondur
                        </button>

                    </div>

                </div>
            </div>

        </div>

        <!-- SAĞ İÇERİK -->
        <div class="col-lg-9">

            <div class="card profil-card">
                <div class="card-body p-4">

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

                    <div class="tab-content" id="v-pills-tabContent">

                        <!-- PROFİL BİLGİLERİ -->
                        <div class="tab-pane fade show active"
                             id="v-pills-profil"
                             role="tabpanel">

                            <h4 class="profil-baslik">
                                Profil Bilgileri
                            </h4>

                            <form action="<?= base_url('profil-guncelle') ?>" method="post">

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ad Soyad</label>
                                        <input type="text"
                                               name="ad_soyad"
                                               class="form-control"
                                               value="<?= esc($kullanici['ad_soyad']) ?>"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">E-Posta</label>
                                        <input type="email"
                                               name="eposta"
                                               class="form-control"
                                               value="<?= esc($kullanici['eposta']) ?>"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Telefon</label>
                                        <input type="text"
                                               name="telefon"
                                               class="form-control"
                                               value="<?= esc($kullanici['telefon']) ?>"
                                               required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kullanıcı Rolü</label>
                                        <input type="text"
                                               class="form-control"
                                               value="<?= esc($kullanici['rol']) ?>"
                                               readonly>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Adres</label>
                                        <textarea name="adres"
                                                  class="form-control"
                                                  rows="3"
                                                  required><?= esc($kullanici['adres']) ?></textarea>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary mt-2">
                                    Bilgileri Güncelle
                                </button>

                            </form>

                        </div>

                        <!-- CÜZDAN -->
                        <div class="tab-pane fade"
                             id="v-pills-cuzdan"
                             role="tabpanel">

                            <h4 class="profil-baslik">
                                BeatSphere Cüzdanım
                            </h4>

                            <div class="cuzdan-box">

                                <div>
                                    <p class="text-muted mb-1">Mevcut Hediye Bakiye</p>

                                    <h2 class="fw-bold mb-0">
                                        <?= number_format($kullanici['bakiye'], 2) ?> ₺
                                    </h2>
                                </div>

                                <i class="fa-solid fa-wallet fa-3x"></i>

                            </div>

                            <p class="text-muted small mt-3">
                                Sipariş iptal edildiğinde iade tutarı bu cüzdana eklenir. Yeni alışverişlerde önce cüzdan bakiyesi kullanılır.
                            </p>

                        </div>

                        <!-- SİPARİŞLERİM -->
                        <div class="tab-pane fade"
                             id="v-pills-siparis"
                             role="tabpanel">

                            <h4 class="profil-baslik">
                                Siparişlerim
                            </h4>

                            <?php if (!empty($siparisler)): ?>

                                <div class="table-responsive">
                                    <table class="table align-middle siparis-table">
                                        <thead>
                                            <tr>
                                               <th>Sipariş No</th>
                                               <th>Tutar</th>
                                               <th>Ödeme</th>
                                               <th>Durum</th>
                                               <th>Tarih</th>
                                               <th>İşlem</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($siparisler as $siparis): ?>
                                                <tr>
                                                    <td>
                                                        #<?= esc($siparis['id']) ?>
                                                    </td>

                                                    <td class="siparis-tutar">
                                                        <?= number_format($siparis['toplam_tutar'], 2) ?> ₺
                                                    </td>

                                                    <td>
                                                        <?= esc($siparis['odeme_yontemi']) ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($siparis['durum'] == 'beklemede'): ?>
                                                            <span class="durum-beklemede">
                                                                Beklemede
                                                            </span>

                                                        <?php elseif ($siparis['durum'] == 'onaylandi'): ?>
                                                            <span class="durum-onaylandi">
                                                                Onaylandı
                                                            </span>

                                                        <?php elseif ($siparis['durum'] == 'iptal'): ?>
                                                            <span class="durum-iptal">
                                                                İptal Edildi
                                                            </span>

                                                        <?php elseif ($siparis['durum'] == 'teslim_edildi'): ?>
                                                            <span class="durum-teslim">
                                                                Teslim Edildi
                                                            </span>

                                                        <?php else: ?>
                                                            <span class="durum-diger">
                                                                <?= esc($siparis['durum']) ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <?= esc($siparis['tarih']) ?>
                                                    </td>

                                                    <td>
                                                        <a href="<?= base_url('siparis-detay/' . $siparis['id']) ?>"
                                                           class="btn btn-sm btn-outline-primary">
                                                            Detay
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php else: ?>

                                <div class="alert alert-light border">
                                    Henüz siparişiniz bulunmuyor.
                                </div>

                            <?php endif; ?>

                        </div>

                        <!-- ŞİFRE DEĞİŞTİR -->
                        <div class="tab-pane fade"
                             id="v-pills-sifre"
                             role="tabpanel">

                            <h4 class="profil-baslik">
                                Şifre Değiştir
                            </h4>

                            <form action="<?= base_url('sifre-guncelle') ?>" method="post">

                                <div class="mb-3">
                                    <label class="form-label">Mevcut Şifre</label>
                                    <input type="password"
                                           name="mevcut_sifre"
                                           class="form-control"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Yeni Şifre</label>
                                    <input type="password"
                                           name="yeni_sifre"
                                           class="form-control"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Yeni Şifre Tekrar</label>
                                    <input type="password"
                                           name="yeni_sifre_tekrar"
                                           class="form-control"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Şifreyi Güncelle
                                </button>

                            </form>

                        </div>

                        <!-- HESABI DONDUR -->
                        <div class="tab-pane fade"
                             id="v-pills-hesap"
                             role="tabpanel">

                            <h4 class="profil-baslik text-danger">
                                Hesabı Dondur
                            </h4>

                            <div class="alert alert-warning">
                                Hesabınızı dondurduğunuzda hesabınız pasif hale gelir ve tekrar giriş yapamazsınız.
                            </div>

                            <form action="<?= base_url('hesap-dondur') ?>" method="post"
      onsubmit="return confirm('Hesabınızı dondurmak istediğinize emin misiniz? Bu işlemden sonra tekrar giriş yapamazsınız.');">

    <button type="submit" class="btn btn-danger">
        Hesabımı Dondur
    </button>

</form>

<p class="text-muted small mt-3 mb-0">
    Hesabınızı dondurduğunuzda hesabınız pasif hale gelir ve tekrar giriş yapamazsınız.
</p>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>