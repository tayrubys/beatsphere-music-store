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

            <form action="<?= $formAction ?>" method="post">

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
                        <label class="form-label">Resim URL</label>
                        <input type="text"
                               name="resim"
                               class="form-control"
                               value="<?= esc($urun['resim'] ?? '') ?>"
                               placeholder="https://..."
                               required>
                    </div>

                    <?php if (!empty($urun['resim'])): ?>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mevcut Resim</label><br>
                            <img src="<?= esc($urun['resim']) ?>"
                                 style="width:120px; height:120px; object-fit:cover; border-radius:12px;">
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

<?= $this->endSection() ?>