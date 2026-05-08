<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><?= esc($baslik) ?></h2>
            <p class="text-muted mb-0">
                Ürün bilgilerini buradan ekleyebilir veya güncelleyebilirsiniz.
            </p>
        </div>

        <a href="<?= base_url('admin/urunler') ?>" class="btn btn-outline-secondary">
            Ürünlere Dön
        </a>
    </div>

    <?php if (session()->getFlashdata('hata')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('hata') ?>
        </div>
    <?php endif; ?>

    <?php
        $formAction = ($islem == 'ekle')
            ? base_url('admin/urun-kaydet')
            : base_url('admin/urun-guncelle/' . $urun['id']);
    ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="<?= $formAction ?>" method="post" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Albüm Adı</label>
                        <input type="text"
                               name="album_adi"
                               class="form-control"
                               value="<?= esc($urun['album_adi'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sanatçı</label>
                        <input type="text"
                               name="sanatci"
                               class="form-control"
                               value="<?= esc($urun['sanatci'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Kategori Seçiniz</option>

                            <?php foreach ($kategoriler as $kategori): ?>
                                <option value="<?= esc($kategori['id']) ?>"
                                    <?= isset($urun['kategori_id']) && $urun['kategori_id'] == $kategori['id'] ? 'selected' : '' ?>>
                                    <?= esc($kategori['kategori_adi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Fiyat</label>
                        <input type="number"
                               step="0.01"
                               name="fiyat"
                               class="form-control"
                               value="<?= esc($urun['fiyat'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number"
                               name="stok"
                               class="form-control"
                               value="<?= esc($urun['stok'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
    <label class="form-label fw-semibold">Ürün Resmi</label>

    <?php if (!empty($urun['resim'])): ?>
    <div class="mb-3 p-3 bg-light rounded d-flex align-items-center gap-3">
        <img src="<?= esc($urun['resim']) ?>"
             style="width:80px; height:80px; object-fit:cover; border-radius:10px; border:1px solid #dee2e6;">
        <div>
            <div class="text-muted small mb-1">Mevcut resim</div>
            <a href="<?= base_url('admin/urun-resim-sil/' . ($urun['id'] ?? '')) ?>"
               class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Resmi silmek istediğinize emin misiniz?')">
                Resmi Kaldır
            </a>
        </div>
    </div>
    <?php endif; ?>

    <ul class="nav nav-tabs mb-3" id="resimTab">
        <li class="nav-item">
            <button class="nav-link active" type="button" onclick="resimSekme('url', this)">
                🔗 URL ile Ekle
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" type="button" onclick="resimSekme('dosya', this)">
                📁 Dosya Yükle
            </button>
        </li>
    </ul>

    <div id="resim-url-alani">
        <input type="text"
               name="resim"
               id="resim_url"
               class="form-control"
               value="<?= esc($urun['resim'] ?? '') ?>"
               placeholder="https://example.com/resim.jpg">
        <div class="form-text">Ürün resminin tam URL adresini girin.</div>
    </div>

    <div id="resim-dosya-alani" style="display:none;">
        <input type="file"
               name="resim_dosya"
               id="resim_dosya"
               class="form-control"
               accept="image/jpeg,image/png,image/webp,image/gif"
               onchange="onizlemeGoster(this)">
        <div class="form-text">JPG, PNG, WEBP veya GIF — maks. 2 MB.</div>
        <div id="resim-onizleme" class="mt-2" style="display:none;">
            <img id="onizleme-img"
                 src=""
                 style="width:100px; height:100px; object-fit:cover; border-radius:10px; border:1px solid #dee2e6;">
        </div>
    </div>
</div>

                    <?php if (!empty($urun['resim'])): ?>
    <div class="col-md-12 mb-3">
        <label class="form-label">Mevcut Resim</label><br>
        <img src="<?= esc($urun['resim']) ?>"
             style="width:120px; height:120px; object-fit:cover; border-radius:12px;">
        <div class="mt-2">
            <a href="<?= base_url('admin/urun-resim-sil/' . ($urun['id'] ?? '')) ?>"
               class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Resmi silmek istediğinize emin misiniz?')">
                 Resmi Sil
            </a>
        </div>
    </div>
<?php endif; ?>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Satış Durumu</label>
                        <select name="durum" class="form-select" required>
                            <option value="satista"
                                <?= isset($urun['durum']) && $urun['durum'] == 'satista' ? 'selected' : '' ?>>
                                Satışta
                            </option>

                            <option value="kaldirildi"
                                <?= isset($urun['durum']) && $urun['durum'] == 'kaldirildi' ? 'selected' : '' ?>>
                                Satışta Değil
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Popüler mi?</label>
                        <select name="populer" class="form-select" required>
                            <option value="0"
                                <?= isset($urun['populer']) && $urun['populer'] == 0 ? 'selected' : '' ?>>
                                Hayır
                            </option>

                            <option value="1"
                                <?= isset($urun['populer']) && $urun['populer'] == 1 ? 'selected' : '' ?>>
                                Evet
                            </option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Açıklama</label>
                        <textarea name="aciklama"
                                  class="form-control"
                                  rows="5"
                                  required><?= esc($urun['aciklama'] ?? '') ?></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-success">
                    <?= $islem == 'ekle' ? 'Ürünü Ekle' : 'Ürünü Güncelle' ?>
                </button>

            </form>

        </div>
    </div>

</div>

<script>
    //eklendi
function resimSekme(tip, btn) {
    document.querySelectorAll('#resimTab .nav-link').forEach(el => el.classList.remove('active'));
    btn.classList.add('active');
    const urlAlani   = document.getElementById('resim-url-alani');
    const dosyaAlani = document.getElementById('resim-dosya-alani');
    if (tip === 'url') {
        urlAlani.style.display   = 'block';
        dosyaAlani.style.display = 'none';
        document.getElementById('resim_dosya').value = '';
        document.getElementById('resim-onizleme').style.display = 'none';
    } else {
        urlAlani.style.display   = 'none';
        dosyaAlani.style.display = 'block';
        document.getElementById('resim_url').value = '';
    }
}

function onizlemeGoster(input) {
    const onizleme = document.getElementById('resim-onizleme');
    const img      = document.getElementById('onizleme-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; onizleme.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?= $this->endSection() ?>