<?= $this->extend('sablon/ana_sablon') ?>
<?= $this->section('icerik') ?>

    <section class="blog-banner-area bg-light py-5 mb-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold text-dark">Biz Kimiz?</h1>
            <p class="lead">Müziğin ritmini Kocaeli'den tüm Türkiye'ye taşıyoruz.</p>
        </div>
    </section>
<div class="container mb-5">
    <div class="row align-items-center">
        
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-4">BeatSphere Müzik Mağazası</h2>
            <p>Müziğe olan tutkumuzla yola çıktık. Plaklardan CD'lere, en yeni pop albümlerinden klasikleşmiş rock eserlerine kadar geniş bir arşivle karşınızdayız.</p>
            <p>Amacımız sadece bir e-ticaret sitesi olmak değil, müzikseverlerin aradıkları o nadir parçaları bulabildikleri dijital bir buluşma noktası yaratmak.</p>
            
            <ul class="list-unstyled mt-4">
                <li class="mb-2"><i class="fa-solid fa-location-dot text-danger me-2"></i> <strong>Adres:</strong> Cumhuriyet Cd. İzmit Merkez, Kocaeli / Türkiye</li>
                <li class="mb-2"><i class="fa-solid fa-envelope text-primary me-2"></i> <strong>E-Posta:</strong> iletisim@beatsphere.com</li>
                <li><i class="fa-solid fa-phone text-success me-2"></i> <strong>Telefon:</strong>+90 555 555 55 55</li>
            </ul>
        </div>

        <div class="col-lg-6">
            <div id="magazaHaritasi" style="height: 400px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.15);"></div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // İzmit Cumhuriyet Caddesi koordinatları
        var map = L.map('magazaHaritasi').setView([40.7654, 29.9408], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(map);
        var marker = L.marker([40.7654, 29.9408]).addTo(map);
        marker.bindPopup("<b>BeatSphere Müzik Mağazası</b><br>Bizi burada ziyaret edebilirsiniz!").openPopup();
    });
</script>

<?= $this->endSection() ?>