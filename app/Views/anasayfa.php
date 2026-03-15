<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        /* Boş kutu (Placeholder) tasarımı */
        .placeholder-img {
            width: 100%;
            height: 250px;
            background-color: #e9ecef; /* Açık gri */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .hero-placeholder {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #141E30 0%, #243B55 100%);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Kart Tasarımları */
        .card-product { border: none; transition: 0.3s; margin-bottom: 30px; background: none; }
        .card-product:hover { transform: translateY(-10px); }
        .card-product__img { position: relative; }
        .section-intro__style { color: #3498db; border-bottom: 2px solid #3498db; }
    </style>

    <main class="site-main">

        <section class="py-5" style="background-color: #f8f9fa;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5 mb-4 mb-md-0">
                        <div class="hero-placeholder shadow">
                            <i class="fa-solid fa-compact-disc fa-spin fa-4x mb-3" style="--fa-animation-duration: 5s;"></i>
                            <p class="small opacity-75">Slider Görselleri Buraya Gelecek</p>
                        </div>
                    </div>
                    <div class="col-md-7 ps-md-5">
                        <h4 class="text-primary">Müzik Keyfi</h4>
                        <h1 class="display-4 fw-bold" style="color: #141E30;">En Sevilen Albümleri Keşfedin</h1>
                        <p class="lead text-muted">BeatSphere kalitesiyle en popüler albümleri keşfedin ve koleksiyonunuzu genişletin.</p>
                        <a class="btn btn-primary btn-lg px-4 mt-3" href="#urunler">Albümlere Göz At</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" id="urunler">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="text-muted mb-1">Yeni Gelenler</p>
                    <h2 class="fw-bold">Popüler <span class="section-intro__style">Albümler</span></h2>
                </div>

                <div class="row">
                    <?php for($i=1; $i<=8; $i++): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <div class="placeholder-img shadow-sm">
                                    <i class="fa-solid fa-music fa-3x"></i>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <p class="text-muted mb-1">Sanatçı Adı</p>
                                <h5 class="fw-bold text-dark">Albüm Adı</h5>
                                <p class="text-primary fw-bold">0.00 ₺</p>
                                <button class="btn btn-sm btn-outline-primary w-100 rounded-pill">Sepete Ekle</button>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

    </main>

<?= $this->endSection() ?>