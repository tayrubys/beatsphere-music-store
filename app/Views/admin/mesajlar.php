<?= $this->extend('sablon/ana_sablon') ?>
 
<?= $this->section('icerik') ?>
 
<div class="container my-5">
 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                İletişim Mesajları
                <?php if ($okunmamis > 0): ?>
                    <span class="badge bg-danger ms-2"><?= $okunmamis ?> Yeni</span>
                <?php endif; ?>
            </h2>
            <p class="text-muted mb-0">Ziyaretçilerin iletişim formundan gönderdiği mesajlar.</p>
        </div>
        <a href="<?= base_url('/admin') ?>" class="btn btn-outline-secondary">
            ← Admin Paneli
        </a>
    </div>
 
    <?php if (session()->getFlashdata('basari')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('basari') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
 
    <div class="card shadow-sm border-0">
        <div class="card-body">
 
            <?php if (!empty($mesajlar)): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Gönderen</th>
                                <th>E-posta</th>
                                <th>Konu</th>
                                <th>Mesaj</th>
                                <th>Tarih</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mesajlar as $mesaj): ?>
                                <tr class="<?= $mesaj['okundu'] == 0 ? 'table-warning fw-semibold' : '' ?>">
                                    <td><?= esc($mesaj['id']) ?></td>
                                    <td><?= esc($mesaj['ad_soyad']) ?></td>
                                    <td><?= esc($mesaj['eposta']) ?></td>
                                    <td><?= esc($mesaj['konu']) ?></td>
                                    <td>
                                        <span title="<?= esc($mesaj['mesaj']) ?>">
                                            <?= esc(mb_substr($mesaj['mesaj'], 0, 60)) ?><?= mb_strlen($mesaj['mesaj']) > 60 ? '...' : '' ?>
                                        </span>
                                    </td>
                                    <td><?= date('d.m.Y H:i', strtotime($mesaj['tarih'])) ?></td>
                                    <td>
                                        <?php if ($mesaj['okundu'] == 0): ?>
                                            <span class="badge bg-warning text-dark">Yeni</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Okundu</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($mesaj['okundu'] == 0): ?>
                                            <a href="<?= base_url('/admin/mesaj-okundu/' . $mesaj['id']) ?>"
                                               class="btn btn-sm btn-success me-1"
                                               title="Okundu İşaretle">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= base_url('/admin/mesaj-sil/' . $mesaj['id']) ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')"
                                           title="Sil">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
 
            <?php else: ?>
                <div class="text-center py-5 text-muted">
                    <i class="fa-solid fa-envelope-open fa-3x mb-3"></i>
                    <p class="fs-5">Henüz hiç mesaj gönderilmemiş.</p>
                </div>
            <?php endif; ?>
 
        </div>
    </div>
</div>
 
<?= $this->endSection() ?>