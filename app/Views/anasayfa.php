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
                       <div class="hero-placeholder shadow p-0 overflow-hidden">

    <?php if (!empty($urunler)): ?>
        <div id="albumSlider" class="carousel slide w-100 h-100" data-bs-ride="carousel">

            <div class="carousel-inner w-100 h-100">

                <?php foreach (array_slice($urunler, 1, 4) as $index => $urun): ?>
                    <div class="carousel-item w-100 h-100 <?= $index == 0 ? 'active' : '' ?>">

                        <a href="<?= base_url('urun/' . $urun['id']) ?>">
                            <img src="<?= esc($urun['resim']) ?>"
                                 class="d-block w-100 h-100"
                                 alt="<?= esc($urun['album_adi']) ?>"
                                 style="object-fit: cover;">
                        </a>

                        <div class="carousel-caption d-none d-md-block"
                             style="background: rgba(0,0,0,0.55); border-radius: 12px; padding: 10px;">
                            <h5 class="fw-bold mb-1">
                                <?= esc($urun['album_adi']) ?>
                            </h5>

                            <p class="mb-0">
                                <?= esc($urun['sanatci']) ?>
                            </p>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

            <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#albumSlider"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#albumSlider"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    <?php else: ?>

        <div class="d-flex align-items-center justify-content-center h-100 text-white">
            <div class="text-center">
                <i class="fa-solid fa-compact-disc fa-spin fa-4x mb-3" style="--fa-animation-duration: 5s;"></i>
                <p class="small opacity-75">Popüler albümler burada gösterilecek.</p>
            </div>
        </div>

    <?php endif; ?>

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
                    <h2 class="fw-bold">Popüler <span class="section-intro__style">Albümler</span></h2>
                </div>

                <div class="row">
                    <?php  foreach($urunler as $urun):?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <a href="<?= base_url('urun/' . $urun['id']) ?>">
                                    <img src="<?= esc($urun['resim']) ?>"
                                    style="width:250px; height:250px; object-fit:cover;">
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <p class="text-muted mb-1"><?= esc($urun['sanatci']) ?></p>
                                <h5 class="fw-bold text-dark"><?= esc($urun['album_adi']) ?></h5>
                                <p class="text-primary fw-bold"><?= number_format($urun['fiyat'], 2) ?> ₺</p>
                                <form action="<?= base_url('sepete-ekle') ?>" method="post">
    <?= csrf_field() ?>

    <input type="hidden" name="urun_id" value="<?= esc($urun['id']) ?>">
    <input type="hidden" name="adet" value="1">

    <button type="submit"
            class="btn btn-sm btn-outline-primary w-100 rounded-pill"
            <?= $urun['stok'] <= 0 ? 'disabled' : '' ?>>
        <?= $urun['stok'] <= 0 ? 'Stok Yok' : 'Sepete Ekle' ?>
    </button>
</form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

<?= $this->endSection() ?>