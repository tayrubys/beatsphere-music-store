<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>  
      .login-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }     
        
      /* Harita çerçevesi ayarları */
      .map-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
      }
      .map-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
      }
      
      /* Uzunlamasına Hava Durumu Kartı İçin Stil */
      .weather-sidebar {
        background: linear-gradient(135deg, #141E30 0%, #243B55 100%);
        color: white;
        border-radius: 10px;
        min-height: 100%; /* Sütunu tamamen doldurması için */
      }
    </style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <section class="blog-banner-area bg-light py-5 mb-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold text-dark">İletişim</h1>
        </div>
    </section>

    <section class="section-margin--small">

        <div class="container-fluid px-lg-5">
            <div class="row">
                
                <!--Hava Durumu -->
                <div class="col-lg-2 d-none d-lg-flex mb-5">
                    <div class="weather-sidebar w-100 p-4 shadow-sm text-center d-flex flex-column align-items-center justify-content-center">
                        <i class="fa-solid fa-cloud-sun mb-4" style="font-size: 4rem; color: #00d2ff;"></i>
                        <h4 class="fw-bold mb-1 text-white" id="hava-durumu-sehir">Kocaeli</h4>
                        <h2 class="display-4 fw-bold text-white my-3" id="hava-durumu-derece">--°C</h2>
                        <hr class="w-50 bg-light opacity-50 my-3">
                        <p id="hava-durumu-desc" class="mb-0 fs-6" style="color: #bbb;">API Yükleniyor...</p>
                    </div>
                </div>

                <!-- SAĞ SÜTUN: Harita ve Form -->
                <div class="col-lg-10">
                    <!-- Harita -->
                    <div class="mb-5 pb-4 map-container-custom">
                        <div id="iletisimHaritasi" style="height: 400px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>
                    </div>

                    <!-- Alt Kısım: İletişim Bilgileri ve Form -->
                    <div class="row">
                        <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                            <div class="media contact-info mb-4 d-flex">
                                <span class="contact-info__icon me-3"><i class="fa-solid fa-house text-primary fs-4"></i></span>
                                <div class="media-body">
                                    <h5 class="fw-bold mb-1">Kocaeli, Türkiye</h5>
                                    <p class="text-muted">Cumhuriyet Cd. İzmit Merkez</p>
                                </div>
                            </div>
                            <div class="media contact-info mb-4 d-flex">
                                <span class="contact-info__icon me-3"><i class="fa-solid fa-phone text-primary fs-4"></i></span>
                                <div class="media-body">
                                    <h5 class="fw-bold mb-1">+90 555 555 55 55</h5>
                                    <p class="text-muted">Pzt - Cmt 09:00 - 18:00</p>
                                </div>
                            </div>
                            <div class="media contact-info d-flex">
                                <span class="contact-info__icon me-3"><i class="fa-solid fa-envelope text-primary fs-4"></i></span>
                                <div class="media-body">
                                    <h5 class="fw-bold mb-1">iletisim@beatsphere.com</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-9">

                            <?php if (session()->getFlashdata('basari')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-check me-2"></i>
                                    <?= session()->getFlashdata('basari') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('hata')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                    <?= session()->getFlashdata('hata') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('iletisim-gonder') ?>" class="form-contact contact_form" method="post" id="contactForm">
                                <?= csrf_field() ?>
                                <div class="row g-3">
                                    <div class="col-lg-5">
                                        <div class="form-group mb-3">
                                            <input class="form-control p-3 border" name="name" id="name" type="text" placeholder="Adınız Soyadınız">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input class="form-control p-3 border" name="email" id="email" type="email" placeholder="E-posta Adresiniz">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input class="form-control p-3 border" name="subject" id="subject" type="text" placeholder="Konu">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <textarea class="form-control p-3 border w-100" name="message" id="message" cols="30" rows="7" placeholder="Mesajınız"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center text-md-end mt-1 mb-5 pb-4">
                                    <button type="submit" class="button button--active btn btn-primary px-5 py-3 shadow">Mesajı Gönder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // harita api
        var map = L.map('iletisimHaritasi').setView([40.7654, 29.9408], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([40.7654, 29.9408]).addTo(map)
            .bindPopup("<b>BeatSphere Mağazası</b><br>İzmit Merkez Şubemiz.")
            .openPopup();
            
        // hava durumu api
        const apiKey = "284dd4ed87d7e9be84141806a64fb4fc"; 
        const city = "Kocaeli";

        fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=tr`)
            .then(response => response.json())
            .then(data => {
                if(data.main && data.weather) {
                    const temp = Math.round(data.main.temp);
                    const desc = data.weather[0].description;
                    const capitalizedDesc = desc.charAt(0).toUpperCase() + desc.slice(1);
                    
                    // Görseldeki dikey karta verileri basıyoruz
                    document.getElementById("hava-durumu-sehir").innerHTML = city;
                    document.getElementById("hava-durumu-derece").innerHTML = `${temp}°C`;
                    document.getElementById("hava-durumu-desc").innerHTML = capitalizedDesc;
                } else {
                    document.getElementById("hava-durumu-desc").innerHTML = "API Bekleniyor...";
                }
            })
            .catch(err => {
                console.error("Hava durumu API hatası:", err);
                document.getElementById("hava-durumu-desc").innerHTML = "Bağlantı hatası.";
            });
    });
</script>

<?= $this->endSection() ?>