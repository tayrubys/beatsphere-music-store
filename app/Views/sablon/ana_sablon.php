<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeatSpherek</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<?= $this->renderSection('css') ?>
    <style>
        /* Navbar ve Buton Özelleştirmeleri */
        .navbar-brand { font-weight: bold; font-size: 1.5rem; color: #333 !important; }
        .nav-shop button { background: none; border: none; font-size: 1.2rem; margin-left: 15px; position: relative; transition: color 0.3s;}
        .nav-shop button:hover { color: #007bff; }
        .nav-shop__circle { position: absolute; top: -8px; right: -10px; background: #007bff; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 50%; font-weight: bold;}
        
        .card-product:hover {
         transform: translateY(-10px);
         box-shadow: 0 10px 25px rgba(0,0,0,0.2);
         transition: 0.3s;
        }
        

        /* Footer Özelleştirmeleri */
        .footer { background-color: #222; color: #ccc; padding-top: 50px; }
        .footer h4 { color: #fff; margin-bottom: 20px; font-size: 1.2rem; }
        .footer a { color: #ccc; text-decoration: none; transition: 0.3s; }
        .footer a:hover { color: #007bff; padding-left: 5px; }
        .footer ul { padding: 0; list-style: none; }
        .footer ul li { margin-bottom: 10px; }
        .social-btn { display: inline-block; width: 35px; height: 35px; background: #333; color: white; text-align: center; line-height: 35px; border-radius: 50%; margin-right: 10px; transition: 0.3s; }
        .social-btn:hover { background: #007bff; color: white; }
        .footer-bottom { background-color: #111; padding: 15px 0; margin-top: 30px; border-top: 1px solid #333;}
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="header_area bg-white shadow-sm sticky-top">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light py-3">
                <div class="container">
                    <a class="navbar-brand logo_h" href="<?= base_url() ?>">
                        <i class="fa-solid fa-compact-disc text-primary"></i> BeatSphere
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav mx-auto">
                            <li class="nav-item mx-2"><a class="nav-link" href="<?= base_url() ?>">Ana Sayfa</a></li>
                            <li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('hakkimizda') ?>">Hakkımızda</a></li>
                            <li class="nav-item dropdown">
                             <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Ürünlerimiz</a>
                             <ul class="dropdown-menu border-0 shadow-sm">
                              <li><a class="dropdown-item" href="<?= site_url('kategori/1') ?>">Pop</a></li>
                              <li><a class="dropdown-item" href="<?= site_url('kategori/2') ?>">Rock</a></li>
                              <li><a class="dropdown-item" href="<?= site_url('kategori/3') ?>">R&B</a></li>
                              <li><a class="dropdown-item" href="<?= site_url('kategori/4') ?>">K-pop</a></li> 
                             </ul>
                            </li>
                            <li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('iletisim') ?>">İletişim</a></li>
                            <li class="nav-item mx-2"><a class="nav-link" href="<?= base_url('kargo_takip') ?>">Kargo Takip</a></li>
                        </ul>

                        <ul class="nav-shop d-flex align-items-center list-unstyled mb-0">
                            <li> 
                                <button onclick="window.location.href='<?= base_url('sepet') ?>'" title="Sepetim">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </li>
                           <ul class="nav-shop d-flex align-items-center list-unstyled mb-0">

        <li class="nav-item dropdown ms-3">
    <button data-bs-toggle="dropdown"
            aria-expanded="false"
            title="Hesabım"
            style="background: none; border: none; font-size: 1.2rem; color: #333;">
        <i class="fa-solid fa-user"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-3"
        style="min-width: 220px; border-radius: 10px;">

        <?php if (session()->get('giris_yapildi')): ?>

            <li>
                <span class="dropdown-item-text text-muted py-2">
                    Merhaba, <?= esc(session()->get('ad_soyad')) ?>
                </span>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item py-2 fw-bold"
                   href="<?= base_url('profil') ?>"
                   style="color: #141E30;">
                    <i class="fa-solid fa-id-card me-2"></i>
                    Profilim / Hesabım
                </a>
            </li>

            <li>
                <a class="dropdown-item py-2 text-danger"
                   href="<?= base_url('logout') ?>">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Çıkış Yap
                </a>
            </li>

        <?php else: ?>

            <li>
                <a class="dropdown-item py-2" href="<?= base_url('login') ?>">
                    <i class="fa-solid fa-right-to-bracket me-2 text-muted"></i>
                    Giriş Yap
                </a>
            </li>

            <li>
                <a class="dropdown-item py-2" href="<?= base_url('register') ?>">
                    <i class="fa-solid fa-user-plus me-2 text-muted"></i>
                    Kayıt Ol
                </a>
            </li>

        <?php endif; ?>

    </ul>
</li>
    </ul>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="flex-grow-1">
        <?= $this->renderSection('icerik') ?>
    </main>
    <footer class="footer mt-auto">
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-footer-widget">
                            <h4>Biz Kimiz?</h4>
                            <p>BeatSphere, dünya müziğinin en sevilen albümlerini kolayca bulup keşfedebileceğiniz modern ve kullanıcı dostu bir albüm satış platformudur.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="single-footer-widget">
                            <h4>Hızlı Linkler</h4>
                            <ul>
                                <li><a href="<?= base_url() ?>">Ana Sayfa</a></li>
                                <li><a href="#">Ürünler</a></li>
                                <li><a href="<?= base_url('hakkimizda') ?>">Hakkımızda</a></li>
                                <li><a href="#">İletişim</a></li>
                                <li><a href="#">Giriş Yap</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 mb-4">
                        <div class="single-footer-widget">
                            <h4>İletişim</h4>
                            <p><i class="fa fa-location-arrow me-2"></i> Kocaeli, Türkiye <br> Teknoloji Fakültesi Bilişim Sistemleri</p>
                            <p><i class="fa fa-phone me-2"></i> +90 555 555 55 55</p>
                            <p><i class="fa fa-envelope me-2"></i> iletisim@beatsphere.com</p>
                            
                            <h5 class="text-white mt-4 mb-3">Sosyal Medya</h5>
                            <div class="social-wrapper">
                                <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                            </div>

                            <p class="mt-4" style="color:#aaa; font-size:0.9rem;">
                                <i class="fa fa-code me-1"></i> Bu web sitesi: <strong class="text-white">Şevval Ceren Yıldız</strong> tarafından tasarlanmıştır.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <p class="mb-0 text-center">
                        © <?= date('Y') ?> Aroma Albüm Satış Sitesi – Tüm Hakları Saklıdır.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>