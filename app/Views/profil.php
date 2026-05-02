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

                    <div class="tab-content" id="v-pills-tabContent">

                        <!-- PROFİL BİLGİLERİ -->
                        <div class="tab-pane fade show active"
                             id="v-pills-profil"
                             role="tabpanel">

                            <h4 class="profil-baslik">
                                Profil Bilgileri
                            </h4>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ad Soyad</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?= esc(session()->get('ad_soyad')) ?>"
                                           readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">E-Posta</label>
                                    <input type="email"
                                           class="form-control"
                                           value="<?= esc(session()->get('eposta')) ?>"
                                           readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kullanıcı Rolü</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?= esc(session()->get('rol')) ?>"
                                           readonly>
                                </div>

                            </div>

                            <button class="btn btn-primary mt-2" disabled>
                                Bilgileri Güncelle
                            </button>

                            <p class="text-muted small mt-3 mb-0">
                                Bu alan daha sonra kullanıcı bilgisi güncelleme için aktif hale getirilebilir.
                            </p>

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
                                Sipariş iptal sistemi yapıldığında, iade tutarları bu cüzdana eklenecek.
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

                            <div class="mb-3">
                                <label class="form-label">Mevcut Şifre</label>
                                <input type="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yeni Şifre</label>
                                <input type="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yeni Şifre Tekrar</label>
                                <input type="password" class="form-control">
                            </div>

                            <button class="btn btn-primary" disabled>
                                Şifreyi Güncelle
                            </button>

                            <p class="text-muted small mt-3 mb-0">
                                Bu alan daha sonra şifre güncelleme sistemi için aktif hale getirilebilir.
                            </p>

                        </div>

                        <!-- HESABI DONDUR -->
                        <div class="tab-pane fade"
                             id="v-pills-hesap"
                             role="tabpanel">

                            <h4 class="profil-baslik text-danger">
                                Hesabı Dondur
                            </h4>

                            <div class="alert alert-warning">
                                Hesabınızı dondurduğunuzda alışveriş ve sipariş işlemleri pasif hale getirilebilir.
                            </div>

                            <button class="btn btn-danger" disabled>
                                Hesabımı Dondur
                            </button>

                            <p class="text-muted small mt-3 mb-0">
                                Bu özellik daha sonra kullanıcı üyeliğini pasif etme kısmında tamamlanabilir.
                            </p>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>