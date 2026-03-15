<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        /* Sitenin Premium Lacivert Temasına Uygun Üst Alan */
        .profil-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }
        .profil-avatar { width: 100px; height: 100px; background-color: white; color: #141E30; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: bold; margin: 0 auto 15px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        
        /* Cüzdan Kartı */
        .bakiye-kart { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        
        /* Sol Menü Tasarımı */
        .nav-pills .nav-link { color: #555; font-weight: 500; border-radius: 8px; margin-bottom: 5px; padding: 12px 20px; transition: 0.3s; }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link { background-color: #243B55; color: white; }
        .nav-pills .nav-link i { width: 25px; }
        
        /* Form ve Butonlar */
        .form-control { border-radius: 5px; padding: 10px 15px; border-color: #ddd; }
        .btn-guncelle { background-color: #243B55; color: white; font-weight: bold; padding: 10px 25px; border-radius: 5px; border: none; transition: 0.3s; }
        .btn-guncelle:hover { background-color: #141E30; color: white; }
    </style>

    <section class="profil-header text-center mb-5">
        <div class="container">
            <div class="profil-avatar"><i class="fa-solid fa-user"></i></div>
            <h2 class="fw-bold">Hoş Geldin, Şevval Ceren</h2>
            <p class="mb-0 text-light" style="opacity: 0.8;">BeatSphere Üyesi</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row">
            
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body p-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active text-start" id="v-pills-profil-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profil" type="button" role="tab"><i class="fa-solid fa-id-card"></i> Profil Bilgileri</button>
                            <button class="nav-link text-start" id="v-pills-cuzdan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cuzdan" type="button" role="tab"><i class="fa-solid fa-wallet"></i> BeatSphere Cüzdanım</button>
                            <button class="nav-link text-start" id="v-pills-sifre-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sifre" type="button" role="tab"><i class="fa-solid fa-lock"></i> Şifre Değiştir</button>
                            <button class="nav-link text-start text-danger mt-3 border-top pt-3" style="border-radius: 0;" id="v-pills-ayarlar-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ayarlar" type="button" role="tab"><i class="fa-solid fa-power-off"></i> Hesabı Dondur</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body p-4">
                        <div class="tab-content" id="v-pills-tabContent">
                            
                            <div class="tab-pane fade show active" id="v-pills-profil" role="tabpanel">
                                <h4 class="fw-bold mb-4 border-bottom pb-2" style="color: #141E30;">Kişisel Bilgiler</h4>
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Ad Soyad</label>
                                            <input type="text" class="form-control" value="Şevval Ceren Yıldız">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">E-Posta Adresi</label>
                                            <input type="email" class="form-control" value="ceren@example.com">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">Telefon</label>
                                            <input type="text" class="form-control" placeholder="05XX XXX XX XX">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label text-muted">Teslimat Adresi</label>
                                            <textarea class="form-control" rows="3" placeholder="Plak ve CD siparişleriniz için açık adresinizi giriniz..."></textarea>
                                        </div>
                                        <div class="col-md-12 text-end mt-2">
                                            <button type="submit" class="btn btn-guncelle"><i class="fa-solid fa-save me-2"></i> Bilgileri Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="v-pills-cuzdan" role="tabpanel">
                                <h4 class="fw-bold mb-4 border-bottom pb-2" style="color: #141E30;">Cüzdanım & Bakiyem</h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="bakiye-kart">
                                            <i class="fa-solid fa-wallet fa-3x mb-3" style="opacity: 0.8;"></i>
                                            <h5 class="mb-1">Mevcut Bakiye</h5>
                                            <h2 class="display-5 fw-bold mb-0">250.00 ₺</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex flex-column justify-content-center mt-4 mt-md-0">
                                        <div class="alert alert-secondary border-0 mb-0">
                                            <h6 class="fw-bold"><i class="fa-solid fa-circle-info text-primary me-2"></i> Bakiye Sistemi Nasıl Çalışır?</h6>
                                            <p class="mb-0 small text-muted">İptal edilen veya iade edilen albüm siparişlerinizin tutarı anında bu cüzdana aktarılır. Yeni yapacağınız alışverişlerde öncelikli olarak buradaki bakiyeniz kullanılır.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-sifre" role="tabpanel">
                                <h4 class="fw-bold mb-4 border-bottom pb-2" style="color: #141E30;">Şifre Değiştir</h4>
                                <form action="#" method="post" style="max-width: 500px;">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Mevcut Şifreniz</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Yeni Şifre</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted">Yeni Şifre (Tekrar)</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-guncelle"><i class="fa-solid fa-key me-2"></i> Şifremi Güncelle</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="v-pills-ayarlar" role="tabpanel">
                                <h4 class="fw-bold text-danger mb-4 border-bottom pb-2">Tehlikeli Bölge</h4>
                                <div class="alert alert-warning border-0" role="alert">
                                    <h6 class="fw-bold text-dark"><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i> Hesabınızı Dondurmak Üzeresiniz</h6>
                                    <p class="mb-0 small text-dark">Hesabınızı dondurduğunuzda profiliniz geçici olarak gizlenir. Sisteme tekrar kullanıcı adı ve şifrenizle giriş yapana kadar yeni albüm siparişi veremezsiniz.</p>
                                </div>
                                <button class="btn btn-outline-danger mt-2 fw-bold"><i class="fa-solid fa-power-off me-2"></i> Hesabımı Dondur (Pasif Et)</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>